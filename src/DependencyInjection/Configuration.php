<?php
namespace Simonetti\Bundle\PingBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('simonetti_ping');
        $rootNode->children()
            ->scalarNode('lock_name')
            ->defaultValue('ping_bundle')
            ->end();
    }

}