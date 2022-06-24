<?php

namespace Simonetti\PingBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $name = 'simonetti_ping';
        $treeBuilder = new TreeBuilder($name);
        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('lock_name')
            ->defaultValue('ping_bundle')
            ->end();
        return $treeBuilder;
    }

}
