<?php

namespace Sylius\Bundle\AddressingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChinaProvinceType extends AbstractType
{
	protected $dataClass;

	public function __construct($dataClass)
	{
		$this->dataClass = $dataClass;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		    ->add('name', 'text', array(
		    	'label' => 'sylius.form.china_province.name'
		    ))
		    ->add('cities', 'collection', array(
   				'type'          => 'sylius_city',
   				'allow_add'     => 'true',
		        'allow_delete'  => 'true',
		        'by_reference'  => false,
		        'label'         => 'sylius.form.china_province.cities'
		    ))
		;
	}


	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver
		    ->setDefaults(array(
                 'data_class'          => $this->dataClass,
		    ))
		;		    
	}

	public function getName()
	{
		return 'sylius_china_province';
	}


}