<?php

declare(strict_types=1);

namespace DobryProgramator\SmartformBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use DobryProgramator\SmartformBundle\Twig\SmartformExtension;

final class DobryProgramatorSmartformExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(SmartformExtension::class);

        if (!array_key_exists('client_id', $config)) {
            return;
        }

        $definition->replaceArgument(0, $config['client_id']);
    }

    public function getAlias(): string
    {
        return 'dobry_programator_smartform';
    }
}
