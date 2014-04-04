<?php

namespace Sylius\Bundle\UniversityAddressing\Bundle\Model;

use Doctrine\Common\Collections\Collection;

interface ChinaProvinceInterface
{
	public function getId();
	public function getName();
	public function setName($name);
	public function getCities();
	public function setCities(Collection $cities);
	public function hasCities();
    public function addCity(CityInterface $city);
    public function removeCity(CityInterface $city);
    public function hasCity(CityInterface $city);
}