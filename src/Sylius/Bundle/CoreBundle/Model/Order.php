<?php

namespace Sylius\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Bundle\AddressingBundle\Model\AddressInterface;
use Sylius\Bundle\CartBundle\Model\Cart;
use Sylius\Bundle\PaymentsBundle\Model\PaymentInterface;
use Sylius\Bundle\PromotionsBundle\Model\CouponInterface;
use Sylius\Bundle\PromotionsBundle\Model\PromotionInterface;
use Sylius\Bundle\OrderBundle\Model\AdjustmentInterface;

/**
 * Order entity.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Order extends Cart implements OrderInterface
{
    /**
     * User.
     *
     * @var UserInterface
     */
     protected $user;

    /**
     * Order shipping address.
     *
     * @var AddressInterface
     */
    protected $shippingAddress;

    /**
     * Order billing address.
     *
     * @var AddressInterface
     */
    protected $billingAddress;

    /**
     * Shipments for this order.
     *
     * @var Collection|ShipmentInterface[]
     */
    protected $shipments;

    /**
     * Simple record the ship state of order
     *
     * @var StringString
     */
    protected $myShipState = OrderInterface::NO_PACKED;


    /**
     * Payment.
     *
     * @var PaymentInterface
     */
    protected $payment;

    /**
     * Currency ISO code.
     *
     * @var string
     */
    protected $currency;

    /**
     * Promotion coupon
     *
     * @var CouponInterface
     */
    protected $promotionCoupon;

    /**
     * Order payment state.
     *
     * @var string
     */
    protected $paymentState = PaymentInterface::STATE_NEW;

    /**
     * Order shipping state.
     * It depends on the status of all order shipments.
     *
     * @var string
     */
    protected $shippingState = OrderShippingStates::CHECKOUT;

    /**
     * the time when the customer get his or her products 
     *
     * 
     * @var datetime
     **/
    protected $endAt = null;

    /**
     * Promotions applied
     *
     * @var ArrayCollection
     */
    protected $promotions;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->shipments = new ArrayCollection();
        $this->promotions = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function setShippingAddress(AddressInterface $address)
    {
        $this->shippingAddress = $address;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function setBillingAddress(AddressInterface $address)
    {
        $this->billingAddress = $address;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxTotal()
    {
        $taxTotal = 0;

        foreach ($this->getTaxAdjustments() as $adjustment) {
            $taxTotal += $adjustment->getAmount();
        }

        return $taxTotal;
    }

    public function getMyShipState()
    {
        return $this->myShipState;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxAdjustments()
    {
        return $this->adjustments->filter(function (AdjustmentInterface $adjustment) {
            return Order::TAX_ADJUSTMENT === $adjustment->getLabel();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function removeTaxAdjustments()
    {
        foreach ($this->getTaxAdjustments() as $adjustment) {
            $this->removeAdjustment($adjustment);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPromotionTotal()
    {
        $promotionTotal = 0;

        foreach ($this->getPromotionAdjustments() as $adjustment) {
            $promotionTotal += $adjustment->getAmount();
        }

        return $promotionTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function getPromotionAdjustments()
    {
        return $this->adjustments->filter(function (AdjustmentInterface $adjustment) {
            return Order::PROMOTION_ADJUSTMENT === $adjustment->getLabel();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function removePromotionAdjustments()
    {
        foreach ($this->getPromotionAdjustments() as $adjustment) {
            $this->removeAdjustment($adjustment);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingTotal()
    {
        $shippingTotal = 0;

        foreach ($this->getShippingAdjustments() as $adjustment) {
            $shippingTotal += $adjustment->getAmount();
        }

        return $shippingTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingAdjustments()
    {
        return $this->adjustments->filter(function (AdjustmentInterface $adjustment) {
            return Order::SHIPPING_ADJUSTMENT === $adjustment->getLabel();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function removeShippingAdjustments()
    {
        foreach ($this->getShippingAdjustments() as $adjustment) {
            $this->removeAdjustment($adjustment);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * {@inheritdoc}
     */
    public function setPayment(PaymentInterface $payment)
    {
        $this->payment = $payment;
        $this->paymentState = $payment->getState();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPaymentState()
    {
        return $this->paymentState;
    }

    /**
     * {@inheritdoc}
     */
    public function setPaymentState($paymentState)
    {
        $this->paymentState = $paymentState;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getInventoryUnits()
    {
        $units = new ArrayCollection;

        foreach ($this->getItems() as $item) {
            foreach ($item->getInventoryUnits() as $unit) {
                $units->add($unit);
            }
        }

        return $units;
    }

    /**
     * {@inheritdoc}
     */
    public function getInventoryUnitsByVariant(VariantInterface $variant)
    {
        return $this->getInventoryUnits()->filter(function (InventoryUnitInterface $unit) use ($variant) {
            return $variant === $unit->getStockable();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getShipments()
    {
        return $this->shipments;
    }

    /**
     * {@inheritdoc}
     */
    public function hasShipments()
    {
        return !$this->shipments->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function addShipment(ShipmentInterface $shipment)
    {
        if (!$this->hasShipment($shipment)) {
            $shipment->setOrder($this);
            $this->shipments->add($shipment);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeShipment(ShipmentInterface $shipment)
    {
        if ($this->hasShipment($shipment)) {
            $shipment->setOrder(null);
            $this->shipments->removeElement($shipment);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasShipment(ShipmentInterface $shipment)
    {
        return $this->shipments->contains($shipment);
    }

    /**
     * {@inheritdoc}
     */
    public function getPromotionCoupon()
    {
        return $this->promotionCoupon;
    }

    /**
     * {@inheritdoc}
     */
    public function setPromotionCoupon(CouponInterface $coupon = null)
    {
        $this->promotionCoupon = $coupon;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPromotionSubjectItemTotal()
    {
        return $this->getItemsTotal();
    }

    /**
     * {@inheritdoc}
     */
    public function getPromotionSubjectItemCount()
    {
        return $this->items->count();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingState()
    {
        return $this->shippingState;
    }

    /**
     * {@inheritdoc}
     */
    public function setShippingState($state)
    {
        $this->shippingState = $state;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isBackorder()
    {
        foreach ($this->getInventoryUnits() as $unit) {
            if (InventoryUnitInterface::STATE_BACKORDERED === $unit->getInventoryState()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets the last updated shipment of the order
     *
     * @return null|ShipmentInterface
     */
    public function getLastShipment()
    {
        if ($this->shipments->isEmpty()) {
            return null;
        }

        $last = $this->shipments->first();
        foreach ($this->shipments as $shipment) {
            if ($shipment->getUpdatedAt() > $last->getUpdatedAt()) {
                $last = $shipment;
            }
        }

        return $last;
    }

    /**
     * Tells is the invoice of the order can be generated.
     *
     * @return Boolean
     */
    public function isInvoiceAvailable()
    {
        if (null !== $lastShipment = $this->getLastShipment()) {
            return (in_array(
                    $lastShipment->getState(),
                    array(ShipmentInterface::STATE_RETURNED, ShipmentInterface::STATE_SHIPPED))
            );
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function hasPromotion(PromotionInterface $promotion)
    {
        return $this->promotions->contains($promotion);
    }

    /**
     * {@inheritdoc}
     */
    public function addPromotion(PromotionInterface $promotion)
    {
        if (!$this->hasPromotion($promotion)) {
            $this->promotions->add($promotion);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removePromotion(PromotionInterface $promotion)
    {
        if ($this->hasPromotion($promotion)) {
            $this->promotions->removeElement($promotion);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPromotions()
    {
        return $this->promotions;
    }

    public function getEndAt()
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTime $endAt = null)
    {
        $this->endAt = $endAt;
    }

    public function end()
    {
        $this->endAt = new \DateTime();
        return $this;
    }

    public function isEnd()
    {
        return null !== $this->endAt;
    }

    public function setMyShipState($myShipState)
    {
        $this->myShipState = $myShipState;

        return $this;
    }
}
