<?php

namespace Sylius\Bundle\WebBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

/**
 * Profile form.
 *
 * @author Julien Janvier <j.janvier@gmail.com>
 */
class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('firstName', 'text', array(
            //     'label'    => 'sylius.form.profile.firstName'
            // ))
            // ->add('lastName', 'text', array(
            //     'label'    => 'sylius.form.profile.lastName'
            // ))
            ->add('nickName', 'text', array(
                   'label'    => 'sylius.form.profile.nickName'))
            ->add('email', 'email', array(
                'label'    => 'sylius.form.profile.email'
            ))
        ;
    }

    public function getName()
    {
        return 'sylius_user_profile';
    }
}
