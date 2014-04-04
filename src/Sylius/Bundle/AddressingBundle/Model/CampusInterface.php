<?php

namespace Sylius\Bundle\AddressingBundle\Model;

use Doctrine\Common\Collections\Collection;

interface CampusInterface
{
	public function __toString();
	public function getId();
	public function getName();
	public function setName($name);
	public function getUniversity();
	public function setUniversity(UniversityInterface $university);
}