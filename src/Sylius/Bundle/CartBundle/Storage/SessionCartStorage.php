<?php


namespace Sylius\Bundle\CartBundle\Storage;

use Sylius\Bundle\CartBundle\Model\CartInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Stores current cart id inside the user session.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class SessionCartStorage implements CartStorageInterface
{
    const KEY = '_sylius.cart-id';

    /**
     * Session.
     *
     * @var SessionInterface
     */
    protected $session;

    /**
     * Key to store the cart id in session.
     *
     * @var string
     */
    protected $key;

    /**
     * Constructor.
     *
     * @param SessionInterface $session
     * @param string           $key
     */
    public function __construct(SessionInterface $session, $key = self::KEY)
    {
        $this->session = $session;
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentCartIdentifier()
    {
        return $this->session->get($this->key);
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrentCartIdentifier(CartInterface $cart)
    {
        $this->session->set($this->key, $cart->getIdentifier());
    }

    /**
     * {@inheritdoc}
     */
    public function resetCurrentCartIdentifier()
    {
        $this->session->remove($this->key);
    }
}
