<?php

namespace Sylius\Bundle\UniversityAddressingBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class City implements CityInterface
{
	protected $id;
	protected $name;
	protected $universities;
	protected $chinaProvince;

    public function __construct()
    {
    	$this->universities = new ArrayCollection();
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

	public function getUniversities()
	{
		return $this->universities;
	}

	public function setUniversities(Collection $universitis)
	{
		$this->universitis = $universitis;
	}	

	public function hasUniversities()
	{
		return !$this->universitis->isEmpty();
	}

	public function addUniversity(UniversityInterface $university)
	{
		if(!$this->hasUniversity($university))
		{
			$this->universities->add($university);
			$university->setCity($this);
		}

		return $this;
	}

	public function removeUniversity(UniversityInterface $university)
    {
        if ($this->hasUniversity($university)) {
            $this->universitis->removeElement($university);
            $university->setCity(null);
        }

        return $this;
    }

    public function hasUniversity(UniversityInterface $university)
    {
        return $this->universitis->contains($university);
    }

}