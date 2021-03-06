<?php

namespace Sylius\Bundle\CartBundle\Event;

use Sylius\Bundle\CartBundle\Model\CartInterface;
use Sylius\Bundle\CartBundle\Model\CartItemInterface;

/**
 * Cart item event.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class CartItemEvent extends CartEvent
{
    /**
     * @var CartItemInterface
     */
    private $item;

    /**
     * @param CartInterface     $cart
     * @param CartItemInterface $item
     */
    public function __construct(CartInterface $cart, CartItemInterface $item)
    {
        parent::__construct($cart);

        $this->item = $item;
    }

    /**
     * @return CartItemInterface
     */
    public function getItem()
    {
        return $this->item;
    }
}
