<?php

namespace Sylius\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Bundle\AddressingBundle\Model\ZoneInterface;
use Sylius\Bundle\ShippingBundle\Model\ShippingCategoryInterface;
use Sylius\Bundle\TaxationBundle\Model\TaxCategoryInterface;
use Sylius\Bundle\VariableProductBundle\Model\VariableProduct as BaseProduct;

/**
 * Sylius core product entity.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Product extends BaseProduct implements ProductInterface
{
    /*
     * Variant selection methods.
     *
     * 1) Choice - A list of all variants is displayed to user.
     *
     * 2) Match  - Each product option is displayed as select field.
     *             User selects the values and we match them to variant.
     */
    const VARIANT_SELECTION_CHOICE = 'choice';
    const VARIANT_SELECTION_MATCH  = 'match';

    /**
     * Short product description.
     * For lists displaying.
     *
     * @var string
     */
    protected $shortDescription;

    /**
     * Variant selection method.
     *
     * @var string
     */
    protected $variantSelectionMethod;

    /**
     * Taxons.
     *
     * @var Collection|TaxonInterface[]
     */
    protected $taxons;

    /**
     * Tax category.
     *
     * @var TaxCategoryInterface
     */
    protected $taxCategory;

    /**
     * Shipping category.
     *
     * @var ShippingCategoryInterface
     */
    protected $shippingCategory;

    /**
     * Not allowed to ship in this zone.
     *
     * @var ZoneInterface
     */
    protected $restrictedZone;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMasterVariant(new Variant());
        $this->taxons = new ArrayCollection();

        $this->variantSelectionMethod = self::VARIANT_SELECTION_CHOICE;
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        if($master = $this->getMasterVariant())
        {
            return $master->getSku();
        }
        
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        $this->getMasterVariant()->setSku($sku);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariantSelectionMethod()
    {
        return $this->variantSelectionMethod;
    }

    /**
     * {@inheritdoc}
     */
    public function setVariantSelectionMethod($variantSelectionMethod)
    {
        if (!in_array($variantSelectionMethod, array(self::VARIANT_SELECTION_CHOICE, self::VARIANT_SELECTION_MATCH))) {
            throw new \InvalidArgumentException(sprintf('Wrong variant selection method "%s" given.', $variantSelectionMethod));
        }

        $this->variantSelectionMethod = $variantSelectionMethod;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isVariantSelectionMethodChoice()
    {
        return self::VARIANT_SELECTION_CHOICE === $this->variantSelectionMethod;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariantSelectionMethodLabel()
    {
        $labels = self::getVariantSelectionMethodLabels();

        return $labels[$this->variantSelectionMethod];
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxons()
    {
        return $this->taxons;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxons(Collection $taxons)
    {
        $this->taxons = $taxons;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->getMasterVariant()->getPrice();
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        $this->getMasterVariant()->setPrice($price);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * {@inheritdoc}
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxCategory()
    {
        return $this->taxCategory;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxCategory(TaxCategoryInterface $category = null)
    {
        $this->taxCategory = $category;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingCategory()
    {
        return $this->shippingCategory;
    }

    /**
     * {@inheritdoc}
     */
    public function setShippingCategory(ShippingCategoryInterface $category = null)
    {
        $this->shippingCategory = $category;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRestrictedZone()
    {
        return $this->restrictedZone;
    }

    /**
     * {@inheritdoc}
     */
    public function setRestrictedZone(ZoneInterface $zone = null)
    {
        $this->restrictedZone = $zone;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages()
    {
        return $this->getMasterVariant()->getImages();
    }

    /**
     * {@inheritdoc}
     */
    public function getImage()
    {
        if($master = $this->getMasterVariant())
        {
            return $master->getImages()->first();
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function getVariantSelectionMethodLabels()
    {
        return array(
            self::VARIANT_SELECTION_CHOICE => 'Variant choice',
            self::VARIANT_SELECTION_MATCH  => 'Options matching',
        );
    }

    public function getStock()
    {
        return $this->getMasterVariant()->getOnHand();
    }

    public function isStockNotZero()
    {
        if($this->getStock() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
