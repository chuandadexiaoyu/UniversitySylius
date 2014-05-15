<?php


namespace Sylius\Bundle\PromotionsBundle\Model;

/**
 * Promotion action model interface.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
interface ActionInterface
{
    const TYPE_FIXED_DISCOUNT      = 'fixed_discount';
    const TYPE_PERCENTAGE_DISCOUNT = 'percentage_discount';

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Set type
     *
     * @param $type
     */
    public function setType($type);

    /**
     * Get configuration
     *
     * @return array
     */
    public function getConfiguration();

    /**
     * Set configuration
     *
     * @param array $configuration
     */
    public function setConfiguration(array $configuration);

    /**
     * Get promotion
     *
     * @return PromotionInterface
     */
    public function getPromotion();

    /**
     * Set promotion
     *
     * @param PromotionInterface $promotion
     */
    public function setPromotion(PromotionInterface $promotion = null);
}
