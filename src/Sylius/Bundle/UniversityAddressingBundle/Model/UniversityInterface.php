<?php

namespace Sylius\Bundle\UniversityAddressing\Bundle\Model;

use Doctrine\Common\Collections\Collection;

interface UniversityInterface
{
	public function getId();
	public function getName();
	public function setName($name);
	public function getCity();
	public function setCity(CityInterface $chinaprovince);
	public function getCampuses();
	public function setCampuses(Collection $universities);
	public function hasCampuses();
	public function addCampus(CampusInterface $university);
    public function removeCampus(CampusInterface $university);
    public function hasCampus(CampusInterface $university);
}