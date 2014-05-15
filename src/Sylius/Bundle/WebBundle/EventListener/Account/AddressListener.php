<?php

namespace Sylius\Bundle\WebBundle\EventListener\Account;

use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Event linked to the creation of an address in the my account section.
 *
 * @author Julien Janvier <j.janvier@gmail.com>
 */
class AddressListener
{
    /**
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @param SecurityContextInterface $securityContext
     */
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * @param ResourceEvent $event
     */
    public function onAddressPreCreate(ResourceEvent $event)
    {
        $user = $this->securityContext->getToken()->getUser();
        $user->addAddress($event->getSubject());
    }

    /**
     * @param ResourceEvent $event
     */
    public function onAddressPreDelete(ResourceEvent $event)
    {
        $address = $event->getSubject();
        $user = $this->securityContext->getToken()->getUser();

        // if ($address === $user->getBillingAddress()) {
        //     $user->setBillingAddress(null);
        // }
        if ($address === $user->getShippingAddress()) {
            $user->setShippingAddress(null);
        }
    }
}
