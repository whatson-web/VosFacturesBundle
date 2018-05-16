<?php

namespace WH\VosFacturesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vos_factures');

        $rootNode
            ->children()
                ->scalarNode('api_token')->isRequired()->end()
                ->booleanNode('testMode')->defaultTrue()->end()
            ->end();

        return $treeBuilder;
    }
}