<?php

namespace Sylius\Bundle\UniversityAddressing\Bundle\Model;

use Doctrine\Common\Collections\Collection;

interface CityInterface
{
	public function getId();
	public function getName();
	public function setName($name);
	public function getChinaProvince();
	public function setChinaProvince(ChinaProvinceInterface $chinaProvince);
	public function getUniversities();
	public function setUniversities(Collection $universities);
	public function hasUniversities();
	public function addUniversity(UniversityInterface $university);
    public function removeUniversity(UniversityInterface $university);
    public function hasUniversity(UniversityInterface $university);
}