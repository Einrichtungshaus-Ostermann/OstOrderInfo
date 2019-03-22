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
 * @ORM\Table(name="ost_orderinfo_orders_positions")
 */
class Position extends ModelEntity
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
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * ...
     *
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="number", type="string", nullable=false)
     */
    private $number;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="ean", type="string", nullable=true)
     */
    private $ean;

    /**
     * ...
     *
     * @var float
     *
     * @ORM\Column(name="amount", type="float", nullable=false)
     */
    private $amount;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="md5", type="string", length=16, nullable=false)
     */
    private $md5;

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
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Setter method for the property.
     *
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Setter method for the property.
     *
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Setter method for the property.
     *
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter method for the property.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * Setter method for the property.
     *
     * @param string $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * Getter method for the property.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Setter method for the property.
     *
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Setter method for the property.
     *
     * @param string $md5
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
    }
}
