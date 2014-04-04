<?php

namespace Sylius\Bundle\CoreBundle\Twig;

use Sylius\Bundle\CoreBundle\Model\ProductInterface;
use Sylius\Bundle\CoreBundle\Model\VariantInterface;


class SyliusInventoryIsAvailableExtension extends \Twig_Extension
{

	public function __construct()
	{
		;
	}

	public function getFunctions()
	{
		return array(
            new \Twig_SimpleFunction('sylius_inventory_is_available', array($this, 'inventoryIsAvailable')),
		);
	}

	public function inventoryIsAvailable(VariantInterface $masterVariant)
	{
		if($masterVariant->getOnHand() > 0)
		{
			return TRUE;
		}else
		{
			return FALSE;
		}
	}
    
    public function getName()
    {
    	return 'sylius_inventory_is_available';
    }

}