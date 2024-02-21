<?php

declare (strict_types=1);

namespace PragmaGoTech\Interview\Validator;

use PragmaGoTech\Interview\Model\LoanProposal;

interface ValidatorInterface {
    public function validate(LoanProposal $loanProposal): void;
}
