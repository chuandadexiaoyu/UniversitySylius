<?php

namespace Sylius\Bundle\AddressingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint to require an address to be shippable
 *
 * @author Daniel Richter <nexyz9@gmail.com>
 */
class ShippableAddressConstraint extends Constraint
{
    public $message = 'sylius.address.not_shippable';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return 'sylius_shippable_address_validator';
    }
}
