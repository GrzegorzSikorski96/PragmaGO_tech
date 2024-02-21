<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Common;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class UnitTestCase extends TestCase
{
    public static ContainerInterface $container;

    public static function setUpBeforeClass(): void
    {
        self::$container = new ContainerBuilder();
        $loader = new YamlFileLoader(self::$container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');   
    }
}