<?php

namespace Sylius\Bundle\CoreBundle\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Translation\TranslatorInterface;

class OrderEndListener
{
	private $session;

	private $translator;

	public function __construct(SessionInterface $session, TranslatorInterface $translator)
	{
		$this->session = $session;

		$this->translator = $translator;
	}

	public function checkEnd(GenericEvent $event)
	{
		$order = $this->getOrder($event);
        
        if($order->getMyShipState() != 'done')
        {
        	$event->stopPropagation();
        }
        $this->session->getBag('flashes')->add('info', $this->translator->trans('sylius.order.not_done', array(), 'flashes'));
	}

	public function End(GenericEvent $event)
	{
		$order = $this->getOrder($event);
        
        $order->End();

        $this->session->getBag('flashes')->add('success', $this->translator->trans('sylius.order.end_success', array(), 'flashes'));
	}

	protected function getOrder(GenericEvent $event)
    {
        $order = $event->getSubject();

        // if (!$order instanceof OrderInterface) {
        //     throw new \InvalidArgumentException(
        //         'Order inventory listener requires event subject to be instance of "Sylius\Bundle\CoreBundle\Model\OrderInterface"'
        //     );
        // }

        return $order;
    }
}