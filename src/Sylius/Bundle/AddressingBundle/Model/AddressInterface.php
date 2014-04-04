<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AddressingBundle\Model;

/**
 * Common address model interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
interface AddressInterface
{

    public function getId();

    public function getNickName();
    public function setNickName($nickName);

    public function getChinaProvince();
    public function setChinaProvince(\Sylius\Bundle\AddressingBundle\Model\ChinaProvince $chinaProvince = null);
    public function getCity();
    public function setCity(\Sylius\Bundle\AddressingBundle\Model\City $city = null);
    public function getUniversity();
    public function setUniversity(\Sylius\Bundle\AddressingBundle\Model\University $university = null);
    public function getCampus();
    public function setCampus(\Sylius\Bundle\AddressingBundle\Model\Campus $campus = null);

    public function getBuildingNumber();
    public function setBuildingNumber($buildingNumber);

    public function getUnit();
    public function setUnit($unit);

    public function getDoorNumber();
    public function setDoorNumber($doorNumber);


    /**
     * Get creation time.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Get modification time.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
}
