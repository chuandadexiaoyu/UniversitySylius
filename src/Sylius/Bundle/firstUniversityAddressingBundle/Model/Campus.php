<?php

namespace Sylius\Bundle\UniversityAddressingBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Campus implements CampusInterface
{
	protected $id;
	protected $name;
	protected $university;

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

	public function getUniversity()
	{
		return $this->university;
	}

	public function setUniversity(UniversityInterface $university)
	{
		$this->university = $university;
		return $this;
	}
	
}