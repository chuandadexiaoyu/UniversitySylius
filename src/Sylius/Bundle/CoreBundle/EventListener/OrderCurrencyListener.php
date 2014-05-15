<?php


namespace Sylius\Bundle\CoreBundle\EventListener;

use Sylius\Bundle\CartBundle\Event\CartEvent;
use Sylius\Bundle\CoreBundle\Model\OrderInterface;
use Sylius\Bundle\MoneyBundle\Context\CurrencyContextInterface;

/**
 * Sets currently selected currency on order object.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class OrderCurrencyListener
{
    protected $currencyContext;

    public function __construct(CurrencyContextInterface $currencyContext)
    {
        $this->currencyContext = $currencyContext;
    }

    public function processOrderCurrency(CartEvent $event)
    {
        $order = $event->getCart();

        if (!$order instanceof OrderInterface) {
            throw new \InvalidArgumentException(
                'Order currency listener requires event subject to be instance of "Sylius\Bundle\CoreBundle\Model\OrderInterface"'
            );
        }

        $order->setCurrency($this->currencyContext->getCurrency());
    }
}
