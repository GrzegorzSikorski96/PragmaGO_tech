<?php

declare (strict_types=1);

namespace PragmaGoTech\Interview\Validator;

use PragmaGoTech\Interview\Model\LoanProposal;

final class MinimumValueValidator implements ValidatorInterface
{
    public function __construct(private readonly float $minimalValue) {
    }

    public function validate(LoanProposal $loanProposal): void
    {
        if ($this->minimalValue > $loanProposal->amount()) {
            throw new ValidationException(sprintf('Value: "%f" is lower than minimal value: "%f"', floatval($loanProposal->amount()), $this->minimalValue));
        }
    }
}