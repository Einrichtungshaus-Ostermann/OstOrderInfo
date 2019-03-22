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
 * @ORM\Table(name="ost_orderinfo_status")
 */
class Status extends ModelEntity
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
     * A grouped key for every iwm status.
     *
     * Values:
     * 1 -> in progress
     * 2 -> delivery planned
     * 3 -> ready for pickup
     * 4 -> delivered
     *
     * @var int
     *
     * @ORM\Column(name="`key`", type="integer", nullable=true)
     */
    private $key;

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
     * @var int
     *
     * @ORM\Column(name="rangeStart", type="integer", nullable=false)
     */
    private $rangeStart;

    /**
     * ...
     *
     * @var int
     *
     * @ORM\Column(name="rangeEnd", type="integer", nullable=false)
     */
    private $rangeEnd;

    /**
     * An additional information text to be shown.
     *
     * @var string
     *
     * @ORM\Column(name="info", type="text", nullable=true)
     */
    private $info;

    /**
     * The type of the information.
     *
     * Values:
     * null -> default (black)
     * 1 -> information (blue)
     * 2 -> warning (red)
     * 3 -> success (green)
     *
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * This status is available for these dispatches.
     * Either null or pipe separated ids.
     *
     * Example:
     * - null
     * - |1|4|12|
     *
     * @var string
     *
     * @ORM\Column(name="dispatch", type="string", nullable=true)
     */
    private $dispatch;

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
     * @return int
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Setter method for the property.
     *
     * @param int $key
     */
    public function setKey($key)
    {
        $this->key = $key;
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
     * @return int
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
    }

    /**
     * Setter method for the property.
     *
     * @param int $rangeStart
     */
    public function setRangeStart($rangeStart)
    {
        $this->rangeStart = $rangeStart;
    }

    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getRangeEnd()
    {
        return $this->rangeEnd;
    }

    /**
     * Setter method for the property.
     *
     * @param int $rangeEnd
     */
    public function setRangeEnd($rangeEnd)
    {
        $this->rangeEnd = $rangeEnd;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Setter method for the property.
     *
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Setter method for the property.
     *
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
}
