<?php

namespace Sylius\Bundle\ResourceBundle\Controller;

use Sylius\Bundle\ResourceBundle\Model\RepositoryInterface;

/**
 * Resource resolver.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class ResourceResolver
{
    /**
     * @var Configuration
     */
    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * Get resources via repository based on the configuration.
     *
     * @param RepositoryInterface $repository
     * @param string              $defaultMethod
     * @param array               $defaultArguments
     *
     * @return mixed
     */
    public function getResource(RepositoryInterface $repository, $defaultMethod, array $defaultArguments = array())
    {
        $callable = array($repository, $this->config->getMethod($defaultMethod));

        $arguments = $this->config->getArguments($defaultArguments);
        
        return call_user_func_array($callable, $arguments);
    }

    /**
     * Create resource.
     *
     * @param RepositoryInterface $repository
     * @param string              $defaultMethod
     * @param array               $defaultArguments
     *
     * @return mixed
     */
    public function createResource(RepositoryInterface $repository, $defaultMethod, array $defaultArguments = array())
    {
        $callable = array($repository, $this->config->getFactoryMethod($defaultMethod));
        $arguments = $this->config->getFactoryArguments($defaultArguments);

        return call_user_func_array($callable, $arguments);
    }
}
