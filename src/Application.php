<?php

declare(strict_types=1);

use Symfony\Component\Config\FileLocator;
use PragmaGoTech\Interview\Model\LoanProposal;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use PragmaGoTech\Interview\Calculator\InterpolatedFeeCalculator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require_once __DIR__.'/../vendor/autoload.php';


$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/../config'));
$loader->load('services.yaml');

$calculator = $containerBuilder->get(InterpolatedFeeCalculator::class);
$loanProposal = new LoanProposal(24, 2750);


$fee = $calculator->calculate($loanProposal);

var_dump($fee);