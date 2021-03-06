<?php

/*
* This file is part of the Sylius package.
*
* (c) Paweł Jędrzejewski
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Sylius\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\UserInterface as BaseUserInterface;
use Sylius\Bundle\AddressingBundle\Model\AddressInterface;
use Sylius\Bundle\ResourceBundle\Model\TimestampableInterface;

/**
 * User interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface UserInterface extends BaseUserInterface, TimestampableInterface
{
    /**
     * Get first name
     */
    public function getFirstName();

    /**
     * Set first name
     *
     * @param string $firstName
     */
    public function setFirstName($firstName);

    // *
    //  * Get last name
     
    public function getLastName();

    /**
     * Set last name
     *
     * @param string $lastName
     */
    public function setLastName($lastName);
    
    public function setNickName($nickName);

    public function getNickName();

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency();

    /**
     * Set currency
     *
     * @param string $currency
     */
    public function setCurrency($currency);

    /**
     * Get orders.
     *
     * @return Collection|OrderInterface
     */
    public function getOrders();


    /**
     * Get shipping address.
     *
     * @return AddressInterface
     */
    public function getShippingAddress();

    /**
     * Set shipping address.
     *
     * @param AddressInterface $shippingAddress
     */
    public function setShippingAddress(AddressInterface $shippingAddress = null);

    /**
     * Get addresses.
     *
     * @return Collection|AddressInterface[]
     */
    public function getAddresses();

    /**
     * Add address.
     *
     * @param AddressInterface $address
     */
    public function addAddress(AddressInterface $address);

    /**
     * Remove address.
     *
     * @param AddressInterface $address
     */
    public function removeAddress(AddressInterface $address);

    /**
     * Has address?
     *
     * @param AddressInterface $address
     *
     * @return Boolean
     */
    public function hasAddress(AddressInterface $address);
}
