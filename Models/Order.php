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

namespace OstOrderInfo\Models;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="ost_orderinfo_orders")
 */
class Order extends ModelEntity
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
     * @ORM\Column(name="number", type="string", length=16, nullable=false)
     */
    private $number;

    /**
     * ...
     *
     * @var int
     *
     * @ORM\Column(name="customerNumber", type="integer", nullable=false)
     */
    private $customerNumber;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="payment", type="string", length=8, nullable=true)
     */
    private $payment;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="dispatch", type="string", length=8, nullable=true)
     */
    private $dispatch;

    /**
     * ...
     *
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * ...
     *
     * @var \DateTime
     *
     * @ORM\Column(name="orderDate", type="date", nullable=true)
     */
    private $orderDate;

    /**
     * If we have a specific delivery date with day, month and year.
     * This is the first priority even if we have a calendar-week given.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="deliveryDate", type="date", nullable=true)
     */
    private $deliveryDate;

    /**
     * The delivery calendar-week saved in the format YYYY-WW = 2019-38.
     *
     * @var string
     *
     * @ORM\Column(name="deliveryCalendarWeek", type="string", length=16, nullable=true)
     */
    private $deliveryCalendarWeek;

    /**
     * ...
     *
     * @var float
     *
     * @ORM\Column(name="articleAmount", type="float", nullable=false)
     */
    private $articleAmount;

    /**
     * ...
     *
     * @var float
     *
     * @ORM\Column(name="orderDiscount", type="float", nullable=false)
     */
    private $orderDiscount;

    /**
     * ...
     *
     * @var float
     *
     * @ORM\Column(name="orderDevalued", type="float", nullable=false)
     */
    private $orderDevalued;

    /**
     * ...
     *
     * @var float
     *
     * @ORM\Column(name="orderAmount", type="float", nullable=false)
     */
    private $orderAmount;

    /**
     * ...
     *
     * @var float
     *
     * @ORM\Column(name="advancePayment", type="float", nullable=false)
     */
    private $advancePayment;

    /**
     * ...
     *
     * @var float
     *
     * @ORM\Column(name="remainingAmount", type="float", nullable=false)
     */
    private $remainingAmount;

    /**
     * The salutation.
     *
     * Values:
     * 0 -> Mr
     * 1 -> Mrs
     *
     * @var int
     *
     * @ORM\Column(name="billingSalutation", type="integer", nullable=true)
     */
    private $billingSalutation;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingFirstname", type="string", nullable=false)
     */
    private $billingFirstname;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingLastname", type="string", nullable=false)
     */
    private $billingLastname;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingCompany", type="string", nullable=true)
     */
    private $billingCompany;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingStreet", type="string", nullable=false)
     */
    private $billingStreet;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingZip", type="string", length=16, nullable=false)
     */
    private $billingZip;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingCity", type="string", nullable=false)
     */
    private $billingCity;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingDistrict", type="string", nullable=true)
     */
    private $billingDistrict;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingCountry", type="string", length=8, nullable=false)
     */
    private $billingCountry;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingPhone", type="string", length=32, nullable=true)
     */
    private $billingPhone;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingPhone2", type="string", length=32, nullable=true)
     */
    private $billingPhone2;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingMobile", type="string", length=32, nullable=true)
     */
    private $billingMobile;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingFax", type="string", length=32, nullable=true)
     */
    private $billingFax;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="billingEmail", type="string", nullable=true)
     */
    private $billingEmail;

    /**
     * The salutation.
     *
     * Values:
     * 0 -> Mr
     * 1 -> Mrs
     *
     * @var int
     *
     * @ORM\Column(name="shippingSalutation", type="integer", nullable=true)
     */
    private $shippingSalutation;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingFirstname", type="string", nullable=false)
     */
    private $shippingFirstname;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingLastname", type="string", nullable=false)
     */
    private $shippingLastname;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingCompany", type="string", nullable=true)
     */
    private $shippingCompany;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingStreet", type="string", nullable=false)
     */
    private $shippingStreet;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingZip", type="string", length=16, nullable=false)
     */
    private $shippingZip;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingCity", type="string", nullable=false)
     */
    private $shippingCity;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingDistrict", type="string", nullable=true)
     */
    private $shippingDistrict;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingCountry", type="string", length=8, nullable=false)
     */
    private $shippingCountry;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingPhone", type="string", length=32, nullable=true)
     */
    private $shippingPhone;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingPhone2", type="string", length=32, nullable=true)
     */
    private $shippingPhone2;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingMobile", type="string", length=32, nullable=true)
     */
    private $shippingMobile;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingFax", type="string", length=32, nullable=true)
     */
    private $shippingFax;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="shippingEmail", type="string", nullable=true)
     */
    private $shippingEmail;

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
     * @return int
     */
    public function getCustomerNumber()
    {
        return $this->customerNumber;
    }

    /**
     * Setter method for the property.
     *
     * @param int $customerNumber
     */
    public function setCustomerNumber($customerNumber)
    {
        $this->customerNumber = $customerNumber;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Setter method for the property.
     *
     * @param string $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getDispatch()
    {
        return $this->dispatch;
    }

    /**
     * Setter method for the property.
     *
     * @param string $dispatch
     */
    public function setDispatch($dispatch)
    {
        $this->dispatch = $dispatch;
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

    /**
     * Getter method for the property.
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Setter method for the property.
     *
     * @param \DateTime $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * Getter method for the property.
     *
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * Setter method for the property.
     *
     * @param \DateTime $deliveryDate
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getDeliveryCalendarWeek()
    {
        return $this->deliveryCalendarWeek;
    }

    /**
     * Setter method for the property.
     *
     * @param string $deliveryCalendarWeek
     */
    public function setDeliveryCalendarWeek($deliveryCalendarWeek)
    {
        $this->deliveryCalendarWeek = $deliveryCalendarWeek;
    }

    /**
     * Getter method for the property.
     *
     * @return float
     */
    public function getArticleAmount()
    {
        return $this->articleAmount;
    }

    /**
     * Setter method for the property.
     *
     * @param float $articleAmount
     */
    public function setArticleAmount($articleAmount)
    {
        $this->articleAmount = $articleAmount;
    }

    /**
     * Getter method for the property.
     *
     * @return float
     */
    public function getOrderDiscount()
    {
        return $this->orderDiscount;
    }

    /**
     * Setter method for the property.
     *
     * @param float $orderDiscount
     */
    public function setOrderDiscount($orderDiscount)
    {
        $this->orderDiscount = $orderDiscount;
    }

    /**
     * Getter method for the property.
     *
     * @return float
     */
    public function getOrderDevalued()
    {
        return $this->orderDevalued;
    }

    /**
     * Setter method for the property.
     *
     * @param float $orderDevalued
     */
    public function setOrderDevalued($orderDevalued)
    {
        $this->orderDevalued = $orderDevalued;
    }

    /**
     * Getter method for the property.
     *
     * @return float
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * Setter method for the property.
     *
     * @param float $orderAmount
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;
    }

    /**
     * Getter method for the property.
     *
     * @return float
     */
    public function getAdvancePayment()
    {
        return $this->advancePayment;
    }

    /**
     * Setter method for the property.
     *
     * @param float $advancePayment
     */
    public function setAdvancePayment($advancePayment)
    {
        $this->advancePayment = $advancePayment;
    }

    /**
     * Getter method for the property.
     *
     * @return float
     */
    public function getRemainingAmount()
    {
        return $this->remainingAmount;
    }

    /**
     * Setter method for the property.
     *
     * @param float $remainingAmount
     */
    public function setRemainingAmount($remainingAmount)
    {
        $this->remainingAmount = $remainingAmount;
    }

    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getBillingSalutation()
    {
        return $this->billingSalutation;
    }

    /**
     * Setter method for the property.
     *
     * @param int $billingSalutation
     */
    public function setBillingSalutation($billingSalutation)
    {
        $this->billingSalutation = $billingSalutation;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingFirstname()
    {
        return $this->billingFirstname;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingFirstname
     */
    public function setBillingFirstname($billingFirstname)
    {
        $this->billingFirstname = $billingFirstname;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingLastname()
    {
        return $this->billingLastname;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingLastname
     */
    public function setBillingLastname($billingLastname)
    {
        $this->billingLastname = $billingLastname;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingCompany()
    {
        return $this->billingCompany;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingCompany
     */
    public function setBillingCompany($billingCompany)
    {
        $this->billingCompany = $billingCompany;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingStreet()
    {
        return $this->billingStreet;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingStreet
     */
    public function setBillingStreet($billingStreet)
    {
        $this->billingStreet = $billingStreet;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingZip()
    {
        return $this->billingZip;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingZip
     */
    public function setBillingZip($billingZip)
    {
        $this->billingZip = $billingZip;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingCity()
    {
        return $this->billingCity;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingCity
     */
    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingDistrict()
    {
        return $this->billingDistrict;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingDistrict
     */
    public function setBillingDistrict($billingDistrict)
    {
        $this->billingDistrict = $billingDistrict;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingCountry
     */
    public function setBillingCountry($billingCountry)
    {
        $this->billingCountry = $billingCountry;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingPhone
     */
    public function setBillingPhone($billingPhone)
    {
        $this->billingPhone = $billingPhone;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingPhone2()
    {
        return $this->billingPhone2;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingPhone2
     */
    public function setBillingPhone2($billingPhone2)
    {
        $this->billingPhone2 = $billingPhone2;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingMobile()
    {
        return $this->billingMobile;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingMobile
     */
    public function setBillingMobile($billingMobile)
    {
        $this->billingMobile = $billingMobile;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingFax()
    {
        return $this->billingFax;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingFax
     */
    public function setBillingFax($billingFax)
    {
        $this->billingFax = $billingFax;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBillingEmail()
    {
        return $this->billingEmail;
    }

    /**
     * Setter method for the property.
     *
     * @param string $billingEmail
     */
    public function setBillingEmail($billingEmail)
    {
        $this->billingEmail = $billingEmail;
    }

    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getShippingSalutation()
    {
        return $this->shippingSalutation;
    }

    /**
     * Setter method for the property.
     *
     * @param int $shippingSalutation
     */
    public function setShippingSalutation($shippingSalutation)
    {
        $this->shippingSalutation = $shippingSalutation;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingFirstname()
    {
        return $this->shippingFirstname;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingFirstname
     */
    public function setShippingFirstname($shippingFirstname)
    {
        $this->shippingFirstname = $shippingFirstname;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingLastname()
    {
        return $this->shippingLastname;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingLastname
     */
    public function setShippingLastname($shippingLastname)
    {
        $this->shippingLastname = $shippingLastname;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingCompany()
    {
        return $this->shippingCompany;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingCompany
     */
    public function setShippingCompany($shippingCompany)
    {
        $this->shippingCompany = $shippingCompany;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingStreet()
    {
        return $this->shippingStreet;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingStreet
     */
    public function setShippingStreet($shippingStreet)
    {
        $this->shippingStreet = $shippingStreet;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingZip()
    {
        return $this->shippingZip;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingZip
     */
    public function setShippingZip($shippingZip)
    {
        $this->shippingZip = $shippingZip;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingCity()
    {
        return $this->shippingCity;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingCity
     */
    public function setShippingCity($shippingCity)
    {
        $this->shippingCity = $shippingCity;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingDistrict()
    {
        return $this->shippingDistrict;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingDistrict
     */
    public function setShippingDistrict($shippingDistrict)
    {
        $this->shippingDistrict = $shippingDistrict;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingCountry()
    {
        return $this->shippingCountry;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingCountry
     */
    public function setShippingCountry($shippingCountry)
    {
        $this->shippingCountry = $shippingCountry;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingPhone()
    {
        return $this->shippingPhone;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingPhone
     */
    public function setShippingPhone($shippingPhone)
    {
        $this->shippingPhone = $shippingPhone;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingPhone2()
    {
        return $this->shippingPhone2;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingPhone2
     */
    public function setShippingPhone2($shippingPhone2)
    {
        $this->shippingPhone2 = $shippingPhone2;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingMobile()
    {
        return $this->shippingMobile;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingMobile
     */
    public function setShippingMobile($shippingMobile)
    {
        $this->shippingMobile = $shippingMobile;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingFax()
    {
        return $this->shippingFax;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingFax
     */
    public function setShippingFax($shippingFax)
    {
        $this->shippingFax = $shippingFax;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getShippingEmail()
    {
        return $this->shippingEmail;
    }

    /**
     * Setter method for the property.
     *
     * @param string $shippingEmail
     */
    public function setShippingEmail($shippingEmail)
    {
        $this->shippingEmail = $shippingEmail;
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
