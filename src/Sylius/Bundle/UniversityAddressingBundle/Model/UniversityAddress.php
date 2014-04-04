<?php

namespace Sylius\Bundle\UniversityAddressingBundle\Model;

use Symfony\Component\Validator\ExecutionContextInterface;

class UniversityAddress implements UniversityAddressInterface
{
	protected $id;
	protected $name;
	protected $chinaProvince;
	protected $city;
	protected $university;
	protected $campus;

	protected $buildingNumber;//which building
    protected $unit;//which in

    protected $createdAt;
    protected $updatedAt;

    public function __construct()
    {
    	$this->createdAt = new \DateTime();
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getName()
    {
    	retunr $this->name;
    }

    public function setName($name)
    {
    	$this->name = $name;
    	return $this;
    }

	public function getChinaProvince()
	{
		return $this->chinaProvince;
	}

	public function setChinaProvince(ChinaProvinceInterface $chinaProvince)
	{
		$this->chinaProvince = $chinaProvince;
		return $this;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function setCity(CityInterface $city)
	{
		$this->city = $city;
		return $this;
	}

	public function getUniversity();
	{
		return $this->university;
	}

	public function setUniversity(UniversityInterface $university)
	{
		$this->university = $university;
		return $this;
	}

	public function getCampus()
	{
		return $this->campus;
	}

	public function setCampus(CampusInterface $campus)
	{
		$this->campus = $campus;
		return $this;
	}

	public function getBuildingNumber()
	{
		return $this->buildingNumber;
	}

	public function setBuildingNumber($buildingNumber)
	{
		$this->buildingNumber = $buildingNumber;
		return $this;
	}

	public function getUnit()
	{
		return $this->unit;
	}

	public function setUnit($unit)
	{
		$this->unit = $unit;
	    return $this;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
}