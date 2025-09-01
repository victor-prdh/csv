<?php declare(strict_types=1);

namespace VictorPrdh\CsvBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use VictorPrdh\CsvBundle\Command\ShowCsvInfoCommand;
use VictorPrdh\CsvBundle\Reader\CsvReader;
use VictorPrdh\CsvBundle\Service\Products;

class CsvBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->services()
            ->set(ShowCsvInfoCommand::class, ShowCsvInfoCommand::class)
            ->autowire()
            ->autoconfigure();

        $container->services()
            ->set(CsvReader::class, CsvReader::class);

        $container->services()
            ->set(Products::class , Products::class)
            ->autowire();
    }
}
