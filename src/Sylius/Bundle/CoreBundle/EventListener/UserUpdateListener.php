<?php

namespace Sylius\Bundle\CoreBundle\EventListener;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * User update listener.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class UserUpdateListener
{
    protected $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function processUser(GenericEvent $event)
    {
        $user = $event->getSubject();

        if (!$user instanceof UserInterface) {
            throw new \InvalidArgumentException(
                'User update listener requires event subject to be instance of "FOS\UserBundle\Model\UserInterface".'
            );
        }

        $this->userManager->reloadUser($user);
    }

    public function updateUserPassword(GenericEvent $event)
    {
        $user = $event->getSubject();

        if (!$user instanceof UserInterface) {
            throw new \InvalidArgumentException(
                'User update listener requires event subject to be instance of "FOS\UserBundle\Model\UserInterface".'
            );
        }

        $this->userManager->updatePassword($user);
    }
}
