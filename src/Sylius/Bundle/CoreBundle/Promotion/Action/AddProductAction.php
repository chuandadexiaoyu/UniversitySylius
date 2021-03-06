<?php

namespace Sylius\Bundle\CoreBundle\Promotion\Action;

use Sylius\Bundle\CoreBundle\Model\OrderItemInterface;
use Sylius\Bundle\PromotionsBundle\Action\PromotionActionInterface;
use Sylius\Bundle\PromotionsBundle\Model\PromotionInterface;
use Sylius\Bundle\PromotionsBundle\Model\PromotionSubjectInterface;
use Sylius\Bundle\ResourceBundle\Model\RepositoryInterface;

/**
 * Free product action.
 *
 * @author Alexandre Bacco <alexandre.bacco@gmail.com>
 */
class AddProductAction implements PromotionActionInterface
{
    /**
     * OrderItem repository.
     *
     * @var RepositoryInterface
     */
    protected $itemRepository;

    /**
     * Variant repository.
     *
     * @var RepositoryInterface
     */
    protected $variantRepository;

    /**
     * Constructor.
     *
     * @param RepositoryInterface $itemRepository
     * @param RepositoryInterface $variantRepository
     */
    public function __construct(RepositoryInterface $itemRepository, RepositoryInterface $variantRepository)
    {
        $this->itemRepository    = $itemRepository;
        $this->variantRepository = $variantRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(PromotionSubjectInterface $subject, array $configuration, PromotionInterface $promotion)
    {
        $promotionItem = $this->createItem($configuration);

        foreach ($subject->getItems() as $item) {
            if ($item->equals($promotionItem)) {
                return;
            }
        }

        $subject->addItem($promotionItem);
    }

    /**
     * {@inheritdoc}
     */
    public function revert(PromotionSubjectInterface $subject, array $configuration, PromotionInterface $promotion)
    {
        $promotionItem = $this->createItem($configuration);

        foreach ($subject->getItems() as $item) {
            if ($item->equals($promotionItem)) {
                $subject->removeItem($item);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigurationFormType()
    {
        return 'sylius_promotion_action_add_product_configuration';
    }

    /**
     * Create promotion item
     *
     * @param  array              $configuration
     * @return OrderItemInterface
     */
    protected function createItem(array $configuration)
    {
        $variant = $this->variantRepository->find($configuration['variant']);

        return $this->itemRepository->createNew()
            ->setVariant($variant)
            ->setQuantity((int) $configuration['quantity'])
            ->setUnitPrice((int) $configuration['price'])
        ;
    }
}
