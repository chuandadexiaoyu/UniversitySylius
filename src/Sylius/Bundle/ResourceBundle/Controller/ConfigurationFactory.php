<?php


namespace Sylius\Bundle\ResourceBundle\Controller;

/**
 * Resource controller configuration factory.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class ConfigurationFactory
{
    /**
     * Current request.
     *
     * @var ParametersParser
     */
    protected $parametersParser;

    /**
     * Constructor.
     *
     * @param ParametersParser $parametersParser
     */
    public function __construct(ParametersParser $parametersParser)
    {
        $this->parametersParser = $parametersParser;
    }

    /**
     * Create configuration for given parameters.
     *
     * @param string $bundlePrefix
     * @param string $resourceName
     * @param string $templateNamespace
     * @param string $templatingEngine
     *
     * @return Configuration
     */
    public function createConfiguration($bundlePrefix, $resourceName, $templateNamespace, $templatingEngine = 'twig')
    {
        return new Configuration(
            $this->parametersParser,
            $bundlePrefix,
            $resourceName,
            $templateNamespace,
            $templatingEngine
        );
    }
}
