<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\InventoryBundle\Operator;

use Doctrine\Common\Collections\Collection;
use Sylius\Bundle\InventoryBundle\Checker\AvailabilityCheckerInterface;
use Sylius\Bundle\InventoryBundle\Model\InventoryUnitInterface;
use Sylius\Bundle\InventoryBundle\Model\StockableInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Sylius\Bundle\InventoryBundle\SyliusStockableEvents;

/**
 * Default inventory operator.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class InventoryOperator implements InventoryOperatorInterface
{
    /**
     * Backorders handler.
     *
     * @var BackordersHandlerInterface
     */
    protected $backordersHandler;

    /**
     * Availability checker.
     *
     * @var AvailabilityCheckerInterface
     */
    protected $availabilityChecker;

    /**
     * Event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Constructor.
     *
     * @param BackordersHandlerInterface   $backordersHandler
     * @param AvailabilityCheckerInterface $availabilityChecker
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(BackordersHandlerInterface $backordersHandler, AvailabilityCheckerInterface $availabilityChecker, EventDispatcherInterface $eventDispatcher)
    {
        $this->backordersHandler = $backordersHandler;
        $this->availabilityChecker = $availabilityChecker;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function increase(StockableInterface $stockable, $quantity)
    {
        if ($quantity < 0) {
            throw new \InvalidArgumentException('Quantity of units must be greater than 0.');
        }

        $this->eventDispatcher->dispatch(SyliusStockableEvents::PRE_INCREASE, new GenericEvent($stockable));

        $stockable->setOnHand($stockable->getOnHand() + $quantity);

        $this->eventDispatcher->dispatch(SyliusStockableEvents::POST_INCREASE, new GenericEvent($stockable));
    }

    /**
     * {@inheritdoc}
     */
    public function hold(StockableInterface $stockable, $quantity)
    {
        // print_r($stockable->getOnHold());
        // print_r('<br>');
        // print_r($quantity);
        // exit('i am here');
        if ($quantity < 0) {
            throw new \InvalidArgumentException('Quantity of units must be greater than 0.');
        }

        $this->eventDispatcher->dispatch(SyliusStockableEvents::PRE_HOLD, new GenericEvent($stockable));

        $stockable->setOnHold($stockable->getOnHold() + $quantity);

        $this->eventDispatcher->dispatch(SyliusStockableEvents::POST_HOLD, new GenericEvent($stockable));
    }

    /**
     * {@inheritdoc}
     */
    public function release(StockableInterface $stockable, $quantity)
    {
        if ($quantity < 0) {
            throw new \InvalidArgumentException('Quantity of units must be greater than 0.');
        }

        $this->eventDispatcher->dispatch(SyliusStockableEvents::PRE_RELEASE, new GenericEvent($stockable));

        $stockable->setOnHold($stockable->getOnHold() - $quantity);

        $this->eventDispatcher->dispatch(SyliusStockableEvents::POST_RELEASE, new GenericEvent($stockable));
    }

    /**
     * {@inheritdoc}
     */
    public function decrease($inventoryUnits)
    {
        if (!is_array($inventoryUnits) && !$inventoryUnits instanceof Collection) {
            throw new \InvalidArgumentException('Inventory units value must be array or instance of "Doctrine\Common\Collections\Collection".');
        }

        $quantity = count($inventoryUnits);

        if ($quantity < 1) {
            throw new \InvalidArgumentException('Quantity of units must be greater than 0.');
        }

        if ($inventoryUnits instanceof Collection) {
            $stockable = $inventoryUnits->first()->getStockable();
        } else {
            $stockable = $inventoryUnits[0]->getStockable();
        }

        if (!$this->availabilityChecker->isStockSufficient($stockable, $quantity)) {
            throw new InsufficientStockException($stockable, $quantity);
        }

        $this->eventDispatcher->dispatch(SyliusStockableEvents::PRE_DECREASE, new GenericEvent($stockable));

        $this->backordersHandler->processBackorders($inventoryUnits);

        $onHand = $stockable->getOnHand();

        foreach ($inventoryUnits as $inventoryUnit) {
            if (InventoryUnitInterface::STATE_SOLD === $inventoryUnit->getInventoryState()) {
                --$onHand;
            }
        }

        $stockable->setOnHand($onHand);

        $this->eventDispatcher->dispatch(SyliusStockableEvents::POST_DECREASE, new GenericEvent($stockable));
    }
}
