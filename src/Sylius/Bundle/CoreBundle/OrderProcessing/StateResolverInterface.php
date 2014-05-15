<?php


namespace Sylius\Bundle\CoreBundle\OrderProcessing;

use Sylius\Bundle\CoreBundle\Model\OrderInterface;

/**
 * Order state resolver.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface StateResolverInterface
{
    /**
     * Figure out the order payment state.
     *
     * @param OrderInterface $order
     */
    public function resolvePaymentState(OrderInterface $order);

    /**
     * Set correct shipping state on the order.
     *
     * @param OrderInterface $order
     */
    public function resolveShippingState(OrderInterface $order);
}
