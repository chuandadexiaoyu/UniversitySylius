<?php

namespace Sylius\Bundle\CoreBundle\Form\Type\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * User filter form type.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class UserFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('query', 'text', array(
                'label' => 'sylius.form.user_filter.query',
                'attr'  => array(
                    'placeholder' => 'sylius.form.user_filter.query'
                )
            ))
        ;
    }

    public function getName()
    {
        return 'sylius_user_filter';
    }
}
