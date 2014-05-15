<?php


namespace Sylius\Bundle\FlowBundle\Process\Step;

use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Step class which extends the base Symfony2 controller.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
abstract class ControllerStep extends Controller implements StepInterface
{
    /**
     * Step name in current scenario.
     *
     * @var string
     */
    protected $name;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function forwardAction(ProcessContextInterface $context)
    {
        return $this->complete();
    }

    /**
     * {@inheritdoc}
     */
    public function isActive()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function complete()
    {
        return new ActionResult();
    }

    /**
     * {@inheritdoc}
     */
    public function proceed($nextStepName)
    {
        return new ActionResult($nextStepName);
    }
}
