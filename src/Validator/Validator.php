<?php

declare (strict_types=1);

namespace PragmaGoTech\Interview\Validator;

use PragmaGoTech\Interview\Model\LoanProposal;

final class Validator implements ValidatorInterface
{
    private array $errors = [];
    private array $constraints = [];

    public function __construct(ValidatorInterface ...$constraints) {
        $this->constraints = $constraints;
    }

    public function validate(LoanProposal $loanProposal): void
    {
        foreach ($this->constraints as $constraint) {
            try {
                $constraint->validate($loanProposal);
            } catch (ValidationException $exception) {
                $this->errors[] = $exception;
            }
        }

        if($this->errors) {
            throw new ValidationException($this->generateExceptionMessage());
        }
    }

    private function generateExceptionMessage(): string {
        $errorMessage = "Validation failed. Errors:\n";

        foreach ($this->errors as $error) {
            $errorMessage .= sprintf("- %s\n", $error->getMessage());
        }

        return $errorMessage;
    }
}