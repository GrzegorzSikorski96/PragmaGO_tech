<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Calculator;

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Validator\Validator;
use PragmaGoTech\Interview\Provider\FeeStructureProvider;
use PragmaGoTech\Interview\Validator\MaximumValueValidator;
use PragmaGoTech\Interview\Validator\MinimumValueValidator;
use PragmaGoTech\Interview\Validator\AvailableTermsValidator;

final class InterpolatedFeeCalculator implements FeeCalculatorInterface
{
    public function __construct(
        private FeeStructureProvider $feeStructureProvider
        ) {
    }

    public function calculate(LoanProposal $loanProposal): float
    {
        $validator = new Validator(
            new MinimumValueValidator(1000),
            new MaximumValueValidator(20000),
            new AvailableTermsValidator(),
        );
        
        $validator->validate($loanProposal);

        $feeStructure = $this->feeStructureProvider->provide($loanProposal->term());

        $lowerBound = $feeStructure->getLowerBound($loanProposal->amount());
        $upperBound = $feeStructure->getUpperBound($loanProposal->amount());

        $factor = InterpolationCalculator::calculateInterpolationFactor($loanProposal->amount(), $lowerBound, $upperBound);
        $interpolatedFee = InterpolationCalculator::interpolateFee($feeStructure->getBreakpoints()[$lowerBound], $feeStructure->getBreakpoints()[$upperBound], $factor);

        $roundedFee = ceil($interpolatedFee);

        $totalAmount = $loanProposal->amount() + $roundedFee;
        $remainder = $totalAmount % 5;

        if ($remainder > 0) {
            $roundedFee += 5 - $remainder;
        }

        return (float)$roundedFee;
    }
}