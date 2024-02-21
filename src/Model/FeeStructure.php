<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

final class FeeStructure
{
    private array $breakpoints = [];

    public function __construct(private int $term, array $breakpoints) {
        $this->breakpoints = $breakpoints;
        
        usort($this->breakpoints, function (Breakpoint $firstBreakpoint, Breakpoint $secondBreakpoint) {
            return $secondBreakpoint->getBreakpoint() <=> $firstBreakpoint->getBreakpoint();
        });
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function getBreakpoints(): array
    {
        return $this->breakpoints;
    }

    public function getLowerBoundIndex(float $loanValue): int
    {
        foreach ($this->breakpoints as $key => $breakpoint) {
            if ($breakpoint->getBreakpoint() <= $loanValue) {
                return $key;
            }
        }

        return null;
    }

    public function getUpperBoundIndex(float $loanValue): int
    {
        $lowerBoundIndex = $this->getLowerBoundIndex($loanValue);

        if ($lowerBoundIndex - 1 < 0) {
            return $lowerBoundIndex;
        }

        return $lowerBoundIndex - 1;
    }
}
