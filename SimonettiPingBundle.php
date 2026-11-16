<?php

namespace Simonetti\PingBundle;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class SimonettiPingBundle extends AbstractBundle
{
    #[\Override]
    public function getPath(): string
    {
        return __DIR__;
    }

    #[\Override]
    public function loadExtension(array $config, ContainerConfigurator $configurator, ContainerBuilder $container): void
    {
        $configurator->import(__DIR__.'/Resources/config/services.yml');
    }
}
