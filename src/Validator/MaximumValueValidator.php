<?php

declare (strict_types=1);

namespace PragmaGoTech\Interview\Validator;

use PragmaGoTech\Interview\Model\LoanProposal;

final class MaximumValueValidator implements ValidatorInterface
{
    public function __construct(private readonly float $maximalValue) {
    }

    public function validate(LoanProposal $loanProposal): void
    {
        if ($this->maximalValue < $loanProposal->amount()) {
            throw new ValidationException(sprintf('Value: "%f" is lower than minimal value: "%f"', floatval($loanProposal->amount()), $this->maximalValue));
        }
    }
}