<?php

namespace Sylius\Bundle\AddressingBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class ChinaProvince implements ChinaProvinceInterface
{
	protected $id;
	protected $name;
	protected $cities;

    public function __construct()
    {
    	$this->cities = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }
    
    public function getId()
    {
    	return $this->id;
    }

    public function getName()
    {
    	return $this->name;
    }

    public function setName($name)
    {
    	$this->name = $name;
    	return $this;
    }

	public function getCities()
	{
		return $this->cities;
	}

	public function setCities(Collection $cities)
	{
		$this->cities = $cities;
		return $this;
	}

	public function hasCities()
	{
		return !$this->cities->isEmpty();
	}

	public function addCity(CityInterface $city)
	{
		if(!$this->hasCity($city))
		{
			$this->cities->add($city);
			$city->setChinaProvince($this);
		}

		return $this;
	}

	public function removeCity(CityInterface $city)
	{
		if($this->hasCity($city))
		{
			$this->cities->removeElement($city);
			$city->setChinaProvince(null);
		}

		return $this;
	}

	public function hasCity(CityInterface $city)
	{
		return $this->cities->contains($city);
	}
	
}
