<?php


namespace Sylius\Bundle\CoreBundle\OrderProcessing;

use Sylius\Bundle\CoreBundle\Model\OrderInterface;
use Sylius\Bundle\ResourceBundle\Model\RepositoryInterface;

/**
 * Payment processor.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class PaymentProcessor implements PaymentProcessorInterface
{
    /**
     * Payment repository.
     *
     * @var RepositoryInterface
     */
    protected $paymentRepository;

    /**
     * Constructor.
     *
     * @param RepositoryInterface $paymentRepository
     */
    public function __construct(RepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function createPayment(OrderInterface $order)
    {
        $payment = $this->paymentRepository->createNew();

        $payment->setCurrency($order->getCurrency());
        $payment->setAmount($order->getTotal());
        $order->setPayment($payment);

        return $payment;
    }
}
