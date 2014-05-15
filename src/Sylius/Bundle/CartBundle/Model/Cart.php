<?php


namespace Sylius\Bundle\CartBundle\Model;

use Sylius\Bundle\OrderBundle\Model\Order;

/**
 * Model for carts.
 * All driver entities and documents should extend this class or implement
 * proper interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Cart extends Order implements CartInterface
{
    /**
     * Expiration time.
     *
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->incrementExpiresAt();
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return parent::getId();
    }

    /**
     * {@inheritdoc}
     */
    public function isExpired()
    {
        return $this->getExpiresAt() < new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setExpiresAt(\DateTime $expiresAt = null)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementExpiresAt()
    {
        $expiresAt = new \DateTime();
        $expiresAt->add(new \DateInterval('PT3H'));

        $this->expiresAt = $expiresAt;

        return $this;
    }
}
