<?php

namespace Sylius\Bundle\AddressingBundle\Form\Type;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Address form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class AddressType extends AbstractType
{
    /**
     * Data class.
     *
     * @var string
     */
    protected $dataClass;

    /**
     * Validation groups.
     *
     * @var string
     */
    protected $validationGroups;

    /**
     * @var EventSubscriberInterface
     */
    protected $eventListener;

    /**
     * Constructor.
     *
     * @param string                   $dataClass
     * @param array                    $validationGroups
     * @param EventSubscriberInterface $eventListener
     */
    public function __construct($dataClass, array $validationGroups, EventSubscriberInterface $eventListener)
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
        $this->eventListener = $eventListener;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //  ->addEventSubscriber($this->eventListener)
            ->add('nickName', 'text', array(
                'label' => 'sylius.form.address.nick_name'
            ))
            ->add('chinaProvince', 'sylius_china_province_choice', array(
                'label' => 'sylius.form.address.china_province',
                'empty_value' => 'sylius.form.china_province.select'
            ))
            ->add('city', 'sylius_city_choice', array(
                'label' => 'sylius.form.address.city',
                'empty_value' => 'sylius.form.city.select'
            ))
            ->add('university', 'sylius_university_choice', array(
                'label' => 'sylius.form.address.university',
                'empty_value' => 'sylius.form.university.select'
            ))
            ->add('campus', 'sylius_campus_choice', array(
                'label' => 'sylius.form.address.campus',
                'empty_value' => 'sylius.form.campus.select'
            ))
            ->add('buildingNumber', 'text', array(
                'label' => 'sylius.form.address.building_number'
            ))
            ->add('unit', 'text', array(
                'label' => 'sylius.form.address.unit'
            ))
            ->add('doorNumber', 'text', array(
                'label' => 'sylius.form.address.door_number'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $validationGroups = $this->validationGroups;

        $resolver
            ->setDefaults(array(
                'data_class'        => $this->dataClass,
                'validation_groups' => function(Options $options) use ($validationGroups) {
                    if ($options['shippable']) {
                        $validationGroups[] = 'shippable';
                    }

                    return $validationGroups;
                },
                'shippable'         => false
            ))
            ->setAllowedTypes(array(
                'shippable' => 'bool'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_address';
    }
}
