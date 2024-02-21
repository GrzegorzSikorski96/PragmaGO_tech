<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

final class Breakpoint
{
    public function __construct(private int $breakpoint, private int $fee) {
    }

    public function getBreakpoint(): int
    {
        return $this->breakpoint;
    }

    public function getFee(): int
    {
        return $this->fee;
    }
}
