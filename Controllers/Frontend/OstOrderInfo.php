<?php declare(strict_types=1);

/*
 * Einrichtungshaus Ostermann GmbH & Co. KG - Order Info
 *
 * @package   OstOrderInfo
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2019 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

use Shopware\Components\CSRFWhitelistAware;

class Shopware_Controllers_Frontend_OstOrderInfo extends Enlight_Controller_Action implements CSRFWhitelistAware
{
    /**
     * ...
     *
     * @return array
     */
    public function getWhitelistedCSRFActions()
    {
        // return all actions
        return array_values(array_filter(
            array_map(
                function ($method) { return (substr($method, -6) === 'Action') ? substr($method, 0, -6) : null; },
                get_class_methods($this)
            ),
            function ($method) { return  !in_array((string) $method, ['', 'index', 'load', 'extends'], true); }
        ));
    }

    /**
     * ...
     *
     * @throws Exception
     */
    public function preDispatch()
    {
        // ...
        $viewDir = $this->container->getParameter('ost_order_info.view_dir');
        $this->get('template')->addTemplateDir($viewDir);
        parent::preDispatch();
    }

    /**
     * ...
     *
     * @throws Exception
     */
    public function indexAction()
    {
        // always get numbers by default
        $orderNumber = $this->request->getParam('orderNumber');
        $customerNumber = $this->request->getParam('customerNumber');

        // default view variable
        $ostOrderInfo = [
            'isLoggedIn' => false,
            'order'      => [],
            'error'      => 0
        ];

        // do we want to show the login?
        if ($this->request->has('orderNumber') === false || $this->request->has('customerNumber') === false) {
            // we are not logged in
            $ostOrderInfo['isLoggedIn'] = false;

            // assign
            $this->view->assign('ostOrderInfo', $ostOrderInfo);

            // show the login
            return;
        }

        // try to find the order
        $query = '
            SELECT
                orders.*,
                payment.name AS paymentName,
                dispatch.name AS dispatchName
            FROM ost_orderinfo_orders AS orders
                LEFT JOIN ost_orderinfo_dispatches AS dispatch
                    ON orders.dispatch = dispatch.id
                LEFT JOIN ost_orderinfo_payments AS payment
                    ON orders.payment = payment.id
            WHERE number = :orderNumber
                AND customerNumber = :customerNumber
            LIMIT 0,1
        ';
        $order = Shopware()->Db()->fetchRow($query, ['orderNumber' => str_pad($orderNumber, 8, '0', STR_PAD_LEFT), 'customerNumber' => $customerNumber]);

        // order found?!
        if (!is_array($order)) {
            // set error
            $ostOrderInfo['isLoggedIn'] = false;
            $ostOrderInfo['error'] = 1;

            // assign
            $this->view->assign('ostOrderInfo', $ostOrderInfo);

            // show the login
            return;
        }

        // get every position
        $query = '
            SELECT *
            FROM ost_orderinfo_orders_positions AS position
            WHERE position.orderNumber = :orderNumber
            ORDER BY position.position ASC
        ';
        $positions = Shopware()->Db()->fetchAll($query, ['orderNumber' => str_pad($orderNumber, 8, '0', STR_PAD_LEFT)]);

        // get the best status
        $query = '
            SELECT
                *,
                ABS(rangeEnd - rangeStart),
                IF(dispatch IS NULL, 0, 1) AS dispatchRestriction
            FROM ost_orderinfo_status
            WHERE :status >= rangeStart
                AND :status <= rangeEnd
                AND ((dispatch IS NULL) OR (dispatch LIKE :dispatch))
            ORDER BY
                dispatchRestriction DESC,
                ABS(rangeEnd - rangeStart) ASC
            LIMIT 0,1
        ';
        $status = Shopware()->Db()->fetchRow($query, ['status' => $order['status'], 'dispatch' => '%|' . $order['dispatch'] . '|%']);

        // set everything
        $order['positions'] = $positions;
        $order['status'] = $status;

        // set it
        $ostOrderInfo['isLoggedIn'] = true;
        $ostOrderInfo['order'] = $order;

        // assign it
        $this->View()->assign('ostOrderInfo', $ostOrderInfo);
    }
}
