<?php


namespace Sylius\Bundle\CoreBundle\Form\Type;

use Sylius\Bundle\OrderBundle\Form\Type\OrderType as BaseOrderType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Order form type.
 * We add two addresses to form, and that's all.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class OrderType extends BaseOrderType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            // ->add('shippingAddress', 'sylius_address')
            // ->add('billingAddress', 'sylius_address')
        ->add('myShipState', 'choice', array('choices' => array('no_pakced'=>'no_pakced', 'packed'=>'packed', 'shipping'=>'shipping', 'done'=>'done')))
        ;
    }
}
