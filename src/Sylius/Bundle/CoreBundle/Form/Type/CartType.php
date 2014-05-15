<?php

namespace Sylius\Bundle\CoreBundle\Form\Type;

use Sylius\Bundle\CartBundle\Form\Type\CartType as BaseCartType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Cart form.
 *
 * @author Julien Janvier <j.janvier@gmail.com>
 */
class CartType extends BaseCartType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('promotionCoupon', 'sylius_promotion_coupon_to_code', array(
                'label'  => 'sylius.form.cart.coupon'
            ))
        ;
    }
}
