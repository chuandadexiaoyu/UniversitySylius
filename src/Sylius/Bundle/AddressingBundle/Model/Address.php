<?php

namespace Sylius\Bundle\AddressingBundle\Model;

use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Default address model.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class Address implements AddressInterface
{
    /**
     * Address id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * City.
     *
     * @var CityInterface
     */
     protected $city;

    /**
     * China Province.
     *
     * @var ChinaProvinceInterface
     */
    protected $chinaProvince;

    /**
     * University.
     *
     * @var UniversityInterface
     */
    protected $university;

    /**
     * Campus.
     *
     * @var CampusInterface
     */
    protected $campus;

    /**
     * NickName.
     *
     * @var string
     */
    protected $nickName;
    
    /**
     * BuildingNumber.
     *
     * @var string
     */
    protected $buildingNumber;
 
    /**
     * Unit.
     *
     * @var string
     */
    protected $unit;
    
    /**
     * HouseNumber.
     *
     * @var string
     */
    protected $doorNumber;

    /**
     * Creation time.
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Update time.
     *
     * @var \DateTime
     */
    protected $updatedAt;



    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function getNickName()
    {
        return $this->nickName;
    }
    
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * {@inheritdoc}
     */
    public function setCity(\Sylius\Bundle\AddressingBundle\Model\City $city = null)
    {
        $this->city = $city;

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set buildingNumber
     *
     * @param string $buildingNumber
     * @return Address
     */
    public function setBuildingNumber($buildingNumber)
    {
        $this->buildingNumber = $buildingNumber;

        return $this;
    }

    /**
     * Get buildingNumber
     *
     * @return string 
     */
    public function getBuildingNumber()
    {
        return $this->buildingNumber;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return Address
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     * @return Address
     */
    public function setDoorNumber($doorNumber)
    {
        $this->doorNumber = $doorNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return string 
     */
    public function getDoorNumber()
    {
        return $this->doorNumber;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Address
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Address
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Set university
     *
     * @param \Sylius\Bundle\AddressingBundle\Model\University $university
     * @return Address
     */
    public function setUniversity(\Sylius\Bundle\AddressingBundle\Model\University $university = null)
    {
        $this->university = $university;

        return $this;
    }

    /**
     * Get university
     *
     * @return \Sylius\Bundle\AddressingBundle\Model\University 
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Set chinaProvince
     *
     * @param \Sylius\Bundle\AddressingBundle\Model\ChinaProvince $chinaProvince
     * @return Address
     */
    public function setChinaProvince(\Sylius\Bundle\AddressingBundle\Model\ChinaProvince $chinaProvince = null)
    {
        $this->chinaProvince = $chinaProvince;

        return $this;
    }

    /**
     * Get chinaProvince
     *
     * @return \Sylius\Bundle\AddressingBundle\Model\ChinaProvince 
     */
    public function getChinaProvince()
    {
        return $this->chinaProvince;
    }

    /**
     * Set campus
     *
     * @param \Sylius\Bundle\AddressingBundle\Model\Campus $campus
     * @return Address
     */
    public function setCampus(\Sylius\Bundle\AddressingBundle\Model\Campus $campus = null)
    {
        $this->campus = $campus;

        return $this;
    }

    /**
     * Get campus
     *
     * @return \Sylius\Bundle\AddressingBundle\Model\Campus 
     */
    public function getCampus()
    {
        return $this->campus;
    }
}
