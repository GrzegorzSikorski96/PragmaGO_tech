<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Provider;

use PragmaGoTech\Interview\Fixtures\FeeStructureFixture;
use PragmaGoTech\Interview\Model\FeeStructure;

final class FeeStructureProvider
{
    private array $feeStructure;

    public function __construct() {
        $this->feeStructure = (new FeeStructureFixture())->load();
    }

    public function provide(int $term): FeeStructure
    {
        return $this->feeStructure[$term];
    }
}