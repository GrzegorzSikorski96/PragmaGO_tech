<?php

declare (strict_types=1);

namespace PragmaGoTech\Interview\Validator;

use PragmaGoTech\Interview\Model\LoanProposal;

final class AvailableTermsValidator implements ValidatorInterface
{
    public function __construct(private readonly array $availableTerms = [12, 24]) {
    }

    public function validate(LoanProposal $loanProposal): void
    {
        if (!in_array($loanProposal->term(), $this->availableTerms)) {
            throw new ValidationException(sprintf('Currently loan for: "%d" is not in out offer.', $loanProposal->term()));
        }
    }
}