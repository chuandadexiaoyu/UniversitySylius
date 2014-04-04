<?php

namespace Sylius\Bundle\UniversityAddressingBundle\Model;

interface UniversityAddressInterface
{
	public function getId();

	public function getName();
	public function setName();

	public function getChinaProvince();
	public function setChinaProvince(ChinaProvinceInterface $chinaProvince);
	public function getCity();
	public function setCity(CityInterface $city);
	public function getUniversity();
	public function setUniversity(UniversityInterface $university);
	public function getCampus();
	public function setCampus(CampusInterface $campus);

	public function getBuildingNumber();
	public function setBuildingNumber($buildingNumber);

	public function getUnit();
	public function setUnit($unit);

	public function getDoorNumber();
	public function setDoorNumber($doorNumber);

	public function getCreatedAt();
	public function getUpdatedAt();
}