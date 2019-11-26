<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Order Info
 *
 * @package   OstOrderInfo
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2019 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstOrderInfo\Commands;

use Enlight_Components_Db_Adapter_Pdo_Mysql as Db;
use OstOrderInfo\Models;
use Shopware\Commands\ShopwareCommand;
use Shopware\Components\Model\ModelManager;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncOrders extends ShopwareCommand
{
    /**
     * ...
     *
     * @var Db
     */
    private $db;

    /**
     * ...
     *
     * @var ModelManager
     */
    private $modelManager;

    /**
     * ...
     *
     * @var array
     */
    private $configuration;

    /**
     * ...
     *
     * @var array
     */
    private $dispatches;

    /**
     * ...
     *
     * @var array
     */
    private $payments;

    /**
     * @param Db           $db
     * @param ModelManager $modelManager
     * @param array        $configuration
     */
    public function __construct(Db $db, ModelManager $modelManager, array $configuration)
    {
        parent::__construct();
        $this->db = $db;
        $this->modelManager = $modelManager;
        $this->configuration = $configuration;
        $this->cachePayments();
        $this->cacheDispatches();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // memory limit
        ini_set("memory_limit", "-1");
        set_time_limit(0);

        // ...
        $output->writeln('reading orders .csv file: ' . rtrim($this->configuration['csvDirectory'], '/') . '/' . $this->configuration['csvOrdersFilename']);

        // ...
        $file = file_get_contents(rtrim($this->configuration['csvDirectory'], '/') . '/' . $this->configuration['csvOrdersFilename']);

        // make it an array and utf8 encode it
        $orders = array_map('trim', explode('<br>', nl2br($file, false)));
        $orders = array_map('utf8_encode', $orders);
        array_shift($orders);

        // ...
        $output->writeln('reading positions .csv file: ' . rtrim($this->configuration['csvDirectory'], '/') . '/' . $this->configuration['csvPositionsFilename']);

        // ...
        $file = file_get_contents(rtrim($this->configuration['csvDirectory'], '/') . '/' . $this->configuration['csvPositionsFilename']);

        // make it an array and utf8 encode it
        $positions = array_map('trim', explode('<br>', nl2br($file, false)));
        $positions = array_map('utf8_encode', $positions);
        array_shift($positions);

        // output
        $output->writeln('orders found: ' . count($orders));
        $output->writeln('positions found: ' . count($positions));

        // ...
        $this->processOrders($orders, $output);
        $this->processPositions($positions, $output);
    }

    /**
     * ...
     *
     * @param array           $orders
     * @param OutputInterface $output
     */
    private function processOrders($orders, OutputInterface $output)
    {
        // ...
        $output->writeln('processing orders');

        // start the progress bar
        $progressBar = new ProgressBar($output, count($orders));
        $progressBar->setRedrawFrequency(10);
        $progressBar->start();

        // ...
        $counter = [
            'lines'         => 0,
            'added'         => 0,
            'updated'       => 0,
            'unchanged'     => 0,
            'invalid-lines' => 0
        ];

        // get every order
        $query = '
            SELECT number, id, status, md5
            FROM ost_orderinfo_orders
        ';
        $arr = Shopware()->Db()->fetchAll($query);

        // all db orders
        $dbOrders = array();

        // ...
        foreach ($arr as $aktu) {
            // set db order with number
            $dbOrders[$aktu['number']] = array('id' => $aktu['id'], 'status' => $aktu['status'], 'md5' => $aktu['md5']);
        }

        // ...
        foreach ($orders as $line) {
            // advance progress bar
            $progressBar->advance();

            // ...
            ++$counter['lines'];

            // get the csv from it
            $csv = str_getcsv($line, ';');

            // at least 44 columns
            if (count($csv) < 44) {
                // invalid
                ++$counter['invalid-lines'];
                continue;
            }

            // create our order array
            $order = $this->getOrder($csv);

            // valid date
            if ((empty($order['number'])) || (empty($order['customerNumber']))) {
                // invalid
                ++$counter['invalid-lines'];
                continue;
            }

            // get the md5
            $md5 = $this->getMd5($order);

            // not found?
            if (!isset($dbOrders[$order['number']])) {
                // count it
                ++$counter['added'];

                // and create a new one
                $model = new Models\Order();
                $model->fromArray($order);
                $model->setMd5($md5);
                $this->modelManager->persist($model);
                $this->modelManager->flush($model);

                // clear
                unset($model);

                // create history
                $model = new Models\Order\History();
                $model->setOrderNumber($order['number']);
                $model->setDate(new \DateTime());
                $model->setStatus($order['status']);
                $this->modelManager->persist($model);
                $this->modelManager->flush($model);

                // clear
                unset($model);

                // next one
                continue;
            }

            // wrong md5?!
            if ($md5 !== $dbOrders[$order['number']]['md5']) {
                // get the db row
                $dbRow = $dbOrders[$order['number']];

                // count it
                ++$counter['updated'];

                // find and update it
                $model = $this->modelManager->find(Models\Order::class, (int) $dbRow['id']);
                $model->fromArray($order);
                $model->setMd5($md5);
                $this->modelManager->flush($model);

                // clear
                unset($model);

                // did we change the status?
                if ((int) $dbRow['status'] !== (int) $order['status']) {
                    // create history
                    $model = new Models\Order\History();
                    $model->setOrderNumber($order['orderNumber']);
                    $model->setDate(new \DateTime());
                    $model->setStatus($order['status']);
                    $this->modelManager->persist($model);
                    $this->modelManager->flush($model);

                    // clear
                    unset($model);
                }

                // and next
                continue;
            }

            // count unchanged
            ++$counter['unchanged'];
        }

        // done
        $progressBar->finish();
        $output->writeln('');

        // ...
        foreach ($counter as $key => $value) {
            // show every counter
            $output->writeln($key . ': ' . $value);
        }
    }

    /**
     * ...
     *
     * @param array           $positions
     * @param OutputInterface $output
     */
    private function processPositions($positions, OutputInterface $output)
    {
        // ...
        $output->writeln('processing positions');

        // start the progress bar
        $progressBar = new ProgressBar($output, count($positions));
        $progressBar->setRedrawFrequency(10);
        $progressBar->start();

        // ...
        $counter = [
            'lines'         => 0,
            'added'         => 0,
            'updated'       => 0,
            'unchanged'     => 0,
            'invalid-lines' => 0
        ];

        // get the positions
        $query = '
            SELECT id, md5, orderNumber, position, number
            FROM ost_orderinfo_orders_positions
        ';
        $arr = $this->db->fetchAll($query);

        // every position
        $dbPositions = array();

        // loop the db
        foreach ($arr as $aktu) {
            // set db order with number
            $dbPositions[$aktu['number'] . '-' . $aktu['position'] . '-' . $aktu['orderNumber']] = array('id' => $aktu['id'], 'md5' => $aktu['md5']);
        }

        // ...
        foreach ($positions as $line) {

            // advance progress bar
            $progressBar->advance();

            // ...
            ++$counter['lines'];

            // get the csv from it
            $csv = str_getcsv($line, ';');


            // at least 8 columns
            if (count($csv) < 8) {
                // invalid
                ++$counter['invalid-lines'];
                continue;
            }

            // create our position array
            $position = $this->getPosition($csv);

            // valid date
            if ((empty($position['orderNumber'])) || (empty($position['number']))) {
                // invalid
                ++$counter['invalid-lines'];
                continue;
            }

            // get the md5
            $md5 = $this->getMd5($position);

            // the unique key to check
            $key = $position['number'] . '-' . $position['position'] . '-' . $position['orderNumber'];

            // not even found?
            if (!isset($dbPositions[$key])) {
                // count it
                ++$counter['added'];

                // and create a new one
                $model = new Models\Order\Position();
                $model->fromArray($position);
                $model->setMd5($md5);
                $this->modelManager->persist($model);
                $this->modelManager->flush($model);

                // clear
                unset($model);

                // next one
                continue;
            }

            // wrong md5?!
            if ($md5 !== $dbPositions[$key]['md5']) {
                // count it
                ++$counter['updated'];

                // find and update it
                $model = $this->modelManager->find(Models\Order\Position::class, (int) $dbPositions[$key]['id']);
                $model->fromArray($position);
                $model->setMd5($md5);
                $this->modelManager->flush($model);

                // clear
                unset($model);

                // and next
                continue;
            }

            // count unchanged
            ++$counter['unchanged'];
        }

        // done
        $progressBar->finish();
        $output->writeln('');

        // ...
        foreach ($counter as $key => $value) {
            // show every counter
            $output->writeln($key . ': ' . $value);
        }
    }

    /**
     * ...
     *
     * @param array $csv
     *
     * @return array
     */
    private function getOrder($csv)
    {
        // create our order array
        $order = [
            'number'               => (string) $csv[0],
            'customerNumber'       => (int) $csv[1],
            'payment'              => (string) $this->getPayment((string) $csv[2]),
            'dispatch'             => (string) $this->getDispatch((int) $csv[3]),
            'status'               => (int) $csv[45],
            'orderDate'            => new \DateTime($csv[6] . '-' . $csv[5] . '-' . $csv[4]),
            'deliveryDate'         => ((int) $csv[41] > 0 && (int) $csv[42] > 0 && (int) $csv[42] <= 12 && (int) $csv[41] <= 31) ? new \DateTime($csv[43] . '-' . $csv[42] . '-' . $csv[41]) : null,
            'deliveryCalendarWeek' => ((int) $csv[44] > 0 && (int) $csv[43] > 0) ? $csv[43] . '-' . $csv[44] : null,
            'articleAmount'        => (float) str_replace(',', '.', (string) $csv[7]),
            'orderDiscount'        => (float) str_replace(',', '.', (string) $csv[8]),
            'orderDevalued'        => (float) str_replace(',', '.', (string) $csv[9]),
            'orderAmount'          => (float) str_replace(',', '.', (string) $csv[10]),
            'advancePayment'       => (float) str_replace(',', '.', (string) $csv[11]),
            'remainingAmount'      => (float) str_replace(',', '.', (string) $csv[12]),
            'billingSalutation'    => (in_array((string) $csv[13], ['Herr', 'Frau'])) ? (((string) $csv[13] === 'Frau') ? 1 : 0) : null,
            'billingFirstname'     => (string) $csv[15],
            'billingLastname'      => (string) $csv[14],
            'billingCompany'       => (!empty((string) $csv[16])) ? (string) $csv[16] : null,
            'billingStreet'        => (string) $csv[17],
            'billingZip'           => (string) $csv[18],
            'billingCity'          => (string) $csv[19],
            'billingDistrict'      => (!empty((string) $csv[20])) ? (string) $csv[20] : null,
            'billingCountry'       => (string) $csv[21],
            'billingPhone'         => (!empty((string) $csv[22])) ? (string) $csv[22] : null,
            'billingPhone2'        => (!empty((string) $csv[23])) ? (string) $csv[23] : null,
            'billingMobile'        => (!empty((string) $csv[24])) ? (string) $csv[24] : null,
            'billingFax'           => (!empty((string) $csv[25])) ? (string) $csv[25] : null,
            'billingEmail'         => (!empty((string) $csv[26])) ? (string) $csv[26] : null,
            'shippingSalutation'   => (in_array((string) $csv[27], ['Herr', 'Frau'])) ? (((string) $csv[27] === 'Frau') ? 1 : 0) : null,
            'shippingFirstname'    => (string) $csv[29],
            'shippingLastname'     => (string) $csv[28],
            'shippingCompany'      => null,
            'shippingStreet'       => (string) $csv[30],
            'shippingZip'          => (string) $csv[31],
            'shippingCity'         => (string) $csv[32],
            'shippingDistrict'     => (!empty((string) $csv[33])) ? (string) $csv[33] : null,
            'shippingCountry'      => (string) $csv[34],
            'shippingPhone'        => (!empty((string) $csv[35])) ? (string) $csv[35] : null,
            'shippingPhone2'       => (!empty((string) $csv[36])) ? (string) $csv[36] : null,
            'shippingMobile'       => (!empty((string) $csv[37])) ? (string) $csv[37] : null,
            'shippingFax'          => (!empty((string) $csv[38])) ? (string) $csv[38] : null,
            'shippingEmail'        => (!empty((string) $csv[39])) ? (string) $csv[39] : null
        ];

        // and return it
        return $order;
    }

    /**
     * ...
     *
     * @param array $csv
     *
     * @return array
     */
    private function getPosition($csv)
    {
        // create our position array
        $order = [
            'orderNumber' => (string) $csv[0],
            'position'    => (int) $csv[1],
            'quantity'    => (int) $csv[6],
            'number'      => (string) $csv[2],
            'name'        => (string) $csv[4],
            'ean'         => (!empty((string) $csv[3])) ? (string) $csv[3] : null,
            'amount'      => (float) str_replace(',', '.', (string) $csv[7])
        ];

        // and return it
        return $order;
    }

    /**
     * ...
     *
     * @param string $name
     *
     * @return string|null
     */
    private function getPayment($name)
    {
        // trim the name
        $name = trim((string) $name);

        // invalid or empty name?
        if ($name === '') {
            // unknown
            return null;
        }

        // try to find the index (= id) for this payment
        $index = array_search($name, $this->payments);

        // not found?
        if ($index === false) {
            // create a new one
            $model = new \OstOrderInfo\Models\Payment();
            $model->setName($name);
            $this->modelManager->persist($model);
            $this->modelManager->flush($model);

            // get the id
            $id = $model->getId();

            // save to cache
            $this->payments[$id] = $name;

            // and return as string
            return (string) $id;
        }

        // return the index id
        return (string) $index;
    }

    /**
     * ...
     *
     * @param int $id
     *
     * @return string|null
     */
    private function getDispatch($id)
    {
        // unknown dispatch?
        if ($id === 0) {
            // nothing to do
            return null;
        }

        // already registered?
        if (isset($this->dispatches[$id])) {
            // return the id
            return $id;
        }

        // insert currently unknown dispatch
        $query = '
            INSERT INTO ost_orderinfo_dispatches
            SET id = :id, `key` = NULL, name = :name
        ';
        $this->db->query($query, ['id' => $id, 'name' => '']);

        // add to cache
        $this->dispatches[$id] = '';

        // return as string
        return (string) $id;
    }

    /**
     * ...
     *
     * @param array $order
     *
     * @return string
     */
    private function getMd5($order)
    {
        // the array to md5 later
        $arr = [];

        // loop every array element
        foreach ($order as $key => $item) {
            // not an object and a simple string, integer etc
            if (!is_object($item)) {
                // append it
                $arr[] = $key . ':' . (string) $item;
                // and next
                continue;
            }

            // specific datetime object
            if ($item instanceof \DateTime) {
                // add it with timestamp
                $arr[] = $key . ':' . $item->getTimestamp();
                // and next
                continue;
            }

            // default unknown object
            $arr[] = $key . ':object';
        }

        // md5 it
        return substr(md5(implode('-', $arr)), 0, 16);
    }

    /**
     * ...
     */
    private function cacheDispatches()
    {
        // get every dispatch
        $query = '
            SELECT id, name
            FROM ost_orderinfo_dispatches
            ORDER BY id ASC
        ';
        $this->dispatches = Shopware()->Db()->fetchPairs($query);
    }

    /**
     * ...
     */
    private function cachePayments()
    {
        // get every payment
        $query = '
            SELECT id, name
            FROM ost_orderinfo_payments
            ORDER BY id ASC
        ';
        $this->payments = Shopware()->Db()->fetchPairs($query);
    }
}
