<?php


namespace Sylius\Bundle\PromotionsBundle\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Promotion subject interface.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PromotionSubjectInterface
{
    /**
     * Get associated coupon
     *
     * @return null|CouponInterface
     */
    public function getPromotionCoupon();

    /**
     * Get number of promotion subjects
     *
     * @return integer
     */
    public function getPromotionSubjectItemCount();

    /**
     * Get total of promotion subjects
     *
     * @return integer
     */
    public function getPromotionSubjectItemTotal();

    /**
     * Has Promotion
     *
     * @param PromotionInterface $promotion
     *
     * @return Boolean
     */
    public function hasPromotion(PromotionInterface $promotion);

    /**
     * Add Promotion
     *
     * @param PromotionInterface $promotion
     *
     * @return self
     */
    public function addPromotion(PromotionInterface $promotion);

    /**
     * Remove Promotion
     *
     * @param PromotionInterface $promotion
     *
     * @return self
     */
    public function removePromotion(PromotionInterface $promotion);

    /**
     * Get Promotions
     *
     * @return Collection|PromotionInterface[]
     */
    public function getPromotions();
}
