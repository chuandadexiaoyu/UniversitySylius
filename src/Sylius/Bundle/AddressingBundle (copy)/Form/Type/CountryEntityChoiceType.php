<?php


namespace Sylius\Bundle\AddressingBundle\Form\Type;

/**
 * Country choice form type for "doctrine/orm" driver.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class CountryEntityChoiceType extends CountryChoiceType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }
}
