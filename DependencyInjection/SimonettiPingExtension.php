<?php
namespace Simonetti\PingBundle\DependencyInjection;

use Simonetti\PingBundle\Lock\FileStorage;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Lock\Factory;

/**
 * Class PingExtension
 * @package Simonetti\PingBundle\DependencyInjection
 */
class SimonettiPingExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $yamlLoader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $yamlLoader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('simonetti.bundle.ping.lock');
        $definition->replaceArgument(0, $config['lock_name']);

        if (class_exists(Factory::class)) {
            $definition = $container->getDefinition('simonetti.bundle.ping.lock_factory');
            $definition->setClass(Factory::class);

            $definition = $container->getDefinition('simonetti.bundle.ping.lock_store');
            $definition->setClass(FileStorage::class);
        }
    }

}
