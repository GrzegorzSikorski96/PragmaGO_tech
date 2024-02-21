<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Unit\Calculator;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use PragmaGoTech\Interview\Tests\Common\UnitTestCase;
use PragmaGoTech\Interview\Calculator\InterpolationCalculator;

class InterpolationCalculatorTest extends UnitTestCase
{
    #[Test]
    #[DataProvider('interpolationDataProvider')]
    public function calculateInterpolationFactor(int $givenValueToCalculate, int $givenLowerBound, int $givenUpperBound, float $exprectedFactor)
    {
        //given

        //when
        $factor = InterpolationCalculator::calculateInterpolationFactor($givenValueToCalculate, $givenLowerBound, $givenUpperBound);

        // //then
        Assert::assertEquals($exprectedFactor, $factor);
    }

    public static function interpolationDataProvider()
    {
        return [
            [10, 5, 15, 0.5],
            [5, 5, 15, 0],
            [15, 5, 15, 1]
        ];
    }

    #[Test]
    #[DataProvider('feeInterpolationDataProvider')]
    public function interpolateFee(int $givenLowerFee, $givenUpperFee, $givenInterpolationFactor, $expectedFee)
    {
        //given

        //when
        $fee = InterpolationCalculator::interpolateFee($givenLowerFee, $givenUpperFee, $givenInterpolationFactor);

        // //then
        Assert::assertEquals($expectedFee, $fee);
    }

    public static function feeInterpolationDataProvider()
    {
        return [
            [5, 15, 0, 5],
            [5, 15, 0.5, 10],
            [5, 15, 1, 15],
            [10, 20, 0.25, 12.5]
        ];
    }
}