<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Unit\Calculator;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Tests\Common\UnitTestCase;
use PragmaGoTech\Interview\Calculator\FeeCalculatorInterface;
use PragmaGoTech\Interview\Calculator\InterpolatedFeeCalculator;

class InterpolatedFeeCalculatorTest extends UnitTestCase
{
    private FeeCalculatorInterface $calculator;

    protected function setUp(): void
    {
        $calculator = self::$container->get(InterpolatedFeeCalculator::class);
        Assert::assertInstanceOf(FeeCalculatorInterface::class, $calculator);
        $this->calculator = $calculator;
    }

    #[Test]
    #[DataProvider('loanProposalWithExpectedValueProvider')]
    public function calculate(LoanProposal $givenLoanProposal, $expectedFee)
    {
        //given

        //when
        $calculatedFee = $this->calculator->calculate($givenLoanProposal);

        // //then
        Assert::assertEquals($expectedFee, $calculatedFee);
    }

    public static function loanProposalWithExpectedValueProvider()
    {
        return [
            [new LoanProposal(12, 1000), 50],
            [new LoanProposal(12, 2000), 90],
            [new LoanProposal(12, 3000), 90],
            [new LoanProposal(12, 4000), 115],
            [new LoanProposal(12, 5000), 100],
            [new LoanProposal(12, 6000), 120],
            [new LoanProposal(12, 7000), 140],
            [new LoanProposal(12, 8000), 160],
            [new LoanProposal(12, 9000), 180],
            [new LoanProposal(12, 10000), 200],
            [new LoanProposal(12, 11000), 220],
            [new LoanProposal(12, 12000), 240],
            [new LoanProposal(12, 13000), 260],
            [new LoanProposal(12, 14000), 280],
            [new LoanProposal(12, 15000), 300],
            [new LoanProposal(12, 16000), 320],
            [new LoanProposal(12, 17000), 340],
            [new LoanProposal(12, 18000), 360],
            [new LoanProposal(12, 19000), 380],
            [new LoanProposal(12, 20000), 400],            
            [new LoanProposal(24, 1000), 70],
            [new LoanProposal(24, 2000), 100],
            [new LoanProposal(24, 3000), 120],
            [new LoanProposal(24, 4000), 160],
            [new LoanProposal(24, 5000), 200],
            [new LoanProposal(24, 6000), 240],
            [new LoanProposal(24, 7000), 280],
            [new LoanProposal(24, 8000), 320],
            [new LoanProposal(24, 9000), 360],
            [new LoanProposal(24, 10000), 400],
            [new LoanProposal(24, 11000), 440],
            [new LoanProposal(24, 12000), 480],
            [new LoanProposal(24, 13000), 520],
            [new LoanProposal(24, 14000), 560],
            [new LoanProposal(24, 15000), 600],
            [new LoanProposal(24, 16000), 640],
            [new LoanProposal(24, 17000), 680],
            [new LoanProposal(24, 18000), 720],
            [new LoanProposal(24, 19000), 760],
            [new LoanProposal(24, 20000), 800],
            [new LoanProposal(24, 2750), 115],
            [new LoanProposal(24, 11500), 460],
            [new LoanProposal(12, 19250), 385],
        ];
    }
}