<?php

namespace Sylius\Bundle\FlowBundle\Process\Step;

/**
 * Tells the coordinator where to go next. Either go to the next
 * step or the one given in the constructor.
 */
class ActionResult
{
    private $stepName;

    public function __construct($stepName = null)
    {
        $this->stepName = $stepName;
    }

    /**
     * @return string|null The name of the next step.
     */
    public function getNextStepName()
    {
        return $this->stepName;
    }
}
