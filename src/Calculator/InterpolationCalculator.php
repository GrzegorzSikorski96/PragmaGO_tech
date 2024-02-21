<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Calculator;

final class InterpolationCalculator
{
    public static function calculateInterpolationFactor(float $amount, int $lowerBreakpoint, int $upperBreakpoint): float
    {
        if($lowerBreakpoint === $upperBreakpoint){
            return 1;
        }

        return ($amount - $lowerBreakpoint) / ($upperBreakpoint - $lowerBreakpoint);
    }

    public static function interpolateFee(int $lowerFee, int $upperFee, float $interpolationFactor): float
    {
        return $lowerFee + $interpolationFactor * ($upperFee - $lowerFee);
    }
}