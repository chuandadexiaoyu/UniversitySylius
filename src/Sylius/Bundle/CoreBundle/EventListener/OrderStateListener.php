<?php

namespace Sylius\Bundle\CoreBundle\EventListener;

use Sylius\Bundle\CoreBundle\Model\OrderInterface;
use Sylius\Bundle\CoreBundle\OrderProcessing\StateResolverInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Order inventory processing listener.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OrderStateListener
{
    /**
     * States resolver.
     *
     * @var StateResolverInterface
     */
    protected $stateResolver;

    /**
     * Constructor.
     *
     * @param StateResolverInterface $stateResolver
     */
    public function __construct(StateResolverInterface $stateResolver)
    {
        $this->stateResolver = $stateResolver;
    }

    /**
     * Get the order from event and run the inventory processor on it.
     *
     * @param GenericEvent $event
     *
     * @throws \InvalidArgumentException
     */
    public function resolveOrderStates(GenericEvent $event)
    {
        $order = $event->getSubject();

        if (!$order instanceof OrderInterface) {
            throw new \InvalidArgumentException(
                'Order inventory listener requires event subject to be an instance of "Sylius\Bundle\CoreBundle\Model\OrderInterface"'
            );
        }

        $this->stateResolver->resolvePaymentState($order);
        $this->stateResolver->resolveShippingState($order);
    }
}
