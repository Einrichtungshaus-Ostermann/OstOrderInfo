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

namespace OstOrderInfo\Models\Order;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="ost_orderinfo_orders_history")
 */
class History extends ModelEntity
{
    /**
     * Auto-generated id.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="orderNumber", type="string", length=16, nullable=false)
     */
    private $orderNumber;

    /**
     * ...
     *
     * @var \DateTime
     *
     * @ORM\Column(name="`date`", type="date", nullable=false)
     */
    private $date;

    /**
     * ...
     *
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Setter method for the property.
     *
     * @param string $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * Getter method for the property.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Setter method for the property.
     *
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Setter method for the property.
     *
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
