<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

final class FeeStructure
{
    private array $breakpoints = [];

    public function __construct(private int $term, array $breakpoints) {
        $this->breakpoints = $breakpoints;
        
        krsort($this->breakpoints);

        // usort($this->breakpoints, function (Breakpoint $firstBreakpoint, Breakpoint $secondBreakpoint) {
        //     return $secondBreakpoint->getBreakpoint() <=> $firstBreakpoint->getBreakpoint();
        // });
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function getBreakpoints(): array
    {
        return $this->breakpoints;
    }

    public function getLowerBound(float $loanValue): int
    {
        foreach ($this->breakpoints as $breakpoint => $fee) {
            if ($breakpoint <= $loanValue) {
                return $breakpoint;
            }
        }

        return null;
    }

    public function getUpperBound(float $loanValue): int
    {
            $breakpoints = array_keys($this->breakpoints);
            $lowerBoundIndex = array_search($this->getLowerBound($loanValue), $breakpoints);
        
            if ($lowerBoundIndex !== false && $lowerBoundIndex > 0) {
                return $breakpoints[$lowerBoundIndex - 1];
            }
        
            return $breakpoints[$lowerBoundIndex];
    }
}
