<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Fixtures;

use PragmaGoTech\Interview\Model\Breakpoint;
use PragmaGoTech\Interview\Model\FeeStructure;

final class FeeStructureFixture
{
    private string $filePath = __DIR__.'/resources/feeStructure.json';

    public function load(): array
    {
        $fileContent = file_get_contents($this->filePath);
        $fixtureData = json_decode($fileContent, true);

        $feeStructures = [];
        foreach($fixtureData as $structure) {
            $breakpoints = [];

            foreach($structure["breakpoints"] as $breakpoint) {
                $breakpoints[] = new Breakpoint($breakpoint['breakpoint'], $breakpoint['fee']);
            }

            $feeStructures[$structure['term']] = new FeeStructure($structure['term'], $breakpoints);
        }

        return $feeStructures;
    }
}