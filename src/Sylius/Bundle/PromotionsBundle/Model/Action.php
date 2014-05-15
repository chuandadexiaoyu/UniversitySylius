<?php

namespace Sylius\Bundle\PromotionsBundle\Model;

/**
 * Promotion action model.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class Action implements ActionInterface
{
    /**
     * The id of this action
     *
     * @var integer
     */
    protected $id;

    /**
     * The type of this action
     *
     * @var string
     */
    protected $type;

    /**
     * The configuration of this action
     *
     * @var array
     */
    protected $configuration = array();

    /**
     * The promotion associated with this action
     *
     * @var PromotionInterface
     */
    protected $promotion;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function setConfiguration(array $configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * {@inheritdoc}
     */
    public function setPromotion(PromotionInterface $promotion = null)
    {
        $this->promotion = $promotion;

        return $this;
    }
}
