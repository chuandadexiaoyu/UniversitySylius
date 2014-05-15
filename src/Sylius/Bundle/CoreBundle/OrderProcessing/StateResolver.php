<?php

namespace Sylius\Bundle\CoreBundle\OrderProcessing;

use Sylius\Bundle\CoreBundle\Model\OrderInterface;
use Sylius\Bundle\CoreBundle\Model\OrderShippingStates;
use Sylius\Bundle\CoreBundle\Model\ShipmentInterface;

/**
 * Order state resolver.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class StateResolver implements StateResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolvePaymentState(OrderInterface $order)
    {
        $order->setPaymentState($order->getPayment()->getState());
    }

    /**
     * {@inheritdoc}
     */
    public function resolveShippingState(OrderInterface $order)
    {
        if ($order->isBackorder()) {
            $order->setShippingState(OrderShippingStates::BACKORDER);

            return;
        }

        $order->setShippingState($this->getShippingState($order));
    }

    protected function getShippingState(OrderInterface $order)
    {
        $states = array();

        foreach ($order->getShipments() as $shipment) {
            $states[] = $shipment->getState();
        }

        $states = array_unique($states);

        $acceptableStates = array(
            ShipmentInterface::STATE_CHECKOUT   => OrderShippingStates::CHECKOUT,
            ShipmentInterface::STATE_ONHOLD     => OrderShippingStates::ONHOLD,
            ShipmentInterface::STATE_READY      => OrderShippingStates::READY,
            ShipmentInterface::STATE_SHIPPED    => OrderShippingStates::SHIPPED,
            ShipmentInterface::STATE_DISPATCHED => OrderShippingStates::DISPATCHED,
            ShipmentInterface::STATE_RETURNED   => OrderShippingStates::RETURNED
        );

        foreach ($acceptableStates as $shipmentState => $orderState) {
            if (array($shipmentState) == $states) {
                return $orderState;
            }
        }

        return OrderShippingStates::PARTIALLY_SHIPPED;
    }
}
