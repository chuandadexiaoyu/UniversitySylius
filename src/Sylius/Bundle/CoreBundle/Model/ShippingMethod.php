<?php


namespace Sylius\Bundle\CoreBundle\Model;

use Sylius\Bundle\AddressingBundle\Model\ZoneInterface;
use Sylius\Bundle\ShippingBundle\Model\ShippingMethod as BaseShippingMethod;

/**
 * Shipping method available for selected zone.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ShippingMethod extends BaseShippingMethod implements ShippingMethodInterface
{
    /**
     * Geographical zone.
     *
     * @var ZoneInterface
     */
    protected $zone;

    /**
     * {@inheritdoc}
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * {@inheritdoc}
     */
    public function setZone(ZoneInterface $zone)
    {
        $this->zone = $zone;

        return $this;
    }
}
