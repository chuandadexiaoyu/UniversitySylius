<?php

namespace Sylius\Bundle\UniversityAddressing\Bundle\Model;

use Doctrine\Common\Collections\Collection;

interface CampusInterface
{
	public function getId();
	public function getName();
	public function setName($name);
	public function getUniversity();
	public function setUniversity(UniversityInterface $university);
}