<?php

namespace WH\VosFacturesBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class VosFacturesExtension
 *
 * @package WH\VosFacturesBundle\DependencyInjection
 */
class VosFacturesExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('vos_factures.api_token', $config['api_token']);
        $container->setParameter('vos_factures.account_name', explode('/', $config['api_token'])[1]);
        $container->setParameter('vos_factures.testMode', $config['testMode']);
    }
}