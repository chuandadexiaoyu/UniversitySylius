<?php

namespace Sylius\Bundle\CartBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Flash message event.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class FlashEvent extends Event
{
    /**
     * Flash message
     *
     * @var string
     */
    protected $message;

    /**
     * @param null|string $message
     */
    public function __construct($message = null)
    {
        $this->message = $message;
    }

    /**
     * Get flash message.
     *
     * @return null|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set flash message.
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}
