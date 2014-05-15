<?php

namespace Sylius\Bundle\CoreBundle\EventListener;

// use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
// use Sylius\Bundle\CartBundle\Event\CartEvent;
// use Sylius\Bundle\CoreBundle\Model\OrderInterface;

class ProductShowListener
{
    public function setProductStock(GenericEvent $event)
    {
        $product = $this->getProduct($event);

        if($product->hasVariants())
        {
            $variants = $product->getVariants();

            $this->clearNagtive($product);

            $master = $product->getMasterVariant();

            $price = $master->getPrice();
            
            foreach ($variants as $variant) {
                if(!$variant->isDeleted())
                {
                    $master->onHandIncrease($variant->getOnHand());
                }

                $price = ($price > ($variant->getPrice()))?($variant->getPrice()):$price;     
            }

            $master->setPrice($price);
        }

    }

    public function setProductPrice(GenericEvent $event)
    {

    }

    protected function getProduct(GenericEvent $event)
    {
        $product = $event->getSubject();

        return $product;
    }

    /******
    *
    * The original number is -masterNumber
    * 
    *
    *****/
    public function clearNagtive($product)
    {
        // $number = $product->getMasterVariant()->getOnHand();
        
        $product->getMasterVariant()->setOnHand(0);

        return $product;
    }
}
