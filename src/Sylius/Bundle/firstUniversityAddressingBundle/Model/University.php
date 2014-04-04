<?php

namespace Sylius\Bundle\UniversityAddressingBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class University implements UniversityInterface
{
	protected $id;
	protected $name;
	protected $campuses;
	protected $city;

    public function __construct()
    {
    	$this->campuses = new ArrayCollection();
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

	public function getCity()
	{
		return $this->city;
	}

	public function setCity(CityInterface $city)
	{
		$this->city = $city;
		return $this;
	}

	public function getCampuses()
	{
		return $this->campuses;
	}

	public function setCampuses(Collection $campuses)
	{
		$this->campuses = $campuses;
	}	

	public function hasCampuses()
	{
		return !$this->campuses->isEmpty();
	}

	public function addCampus(CampusInterface $campus)
	{
		if(!$this->hasCampus($campus))
		{
			$this->campuses->add($campus);
			$campus->setuniversity($this);
		}

		return $this;
	}

	public function removeCampus(CampusInterface $campus)
    {
        if ($this->hasCampus($campus)) {
            $this->campuses->removeElement($campus);
            $campus->setUniversity(null);
        }

        return $this;
    }

    public function hasCampus(CampusInterface $campus)
    {
        return $this->campuses->contains($campus);
    }

}