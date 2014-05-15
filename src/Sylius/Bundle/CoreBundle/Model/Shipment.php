<?php

namespace Sylius\Bundle\CoreBundle\Model;

use Sylius\Bundle\ShippingBundle\Model\Shipment as BaseShipment;

/**
 * Shipment attached to order.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Shipment extends BaseShipment implements ShipmentInterface
{
    /**
     * Order.
     *
     * @var OrderInterface
     */
    protected $order;

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrder(OrderInterface $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingWeight()
    {
        $weight = 0;

        foreach ($this->items as $item) {
            $weight += $item->getShippable()->getShippingWeight();
        }

        return $weight;
    }
}
