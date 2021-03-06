<?php

namespace Sylius\Bundle\CartBundle\Doctrine\ORM;

use Datetime;
use Sylius\Bundle\CartBundle\Repository\CartRepositoryInterface;
use Sylius\Bundle\OrderBundle\Doctrine\ORM\OrderRepository;
use Sylius\Bundle\OrderBundle\Model\OrderInterface;

/**
 * Default cart entity repository.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 * @author Alexandre Bacco <alexandre.bacco@gmail.com>
 */
class CartRepository extends OrderRepository implements CartRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findExpiredCarts()
    {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->andWhere($queryBuilder->expr()->lt($this->getAlias().'.expiresAt', ':now'))
            ->andWhere($queryBuilder->expr()->eq($this->getAlias().'.state', OrderInterface::STATE_CART))
            ->setParameter('now', new Datetime())
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
