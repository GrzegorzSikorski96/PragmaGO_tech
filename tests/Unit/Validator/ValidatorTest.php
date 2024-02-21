<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Unit\Calculator;

use PHPUnit\Framework\Attributes\Test;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Tests\Common\UnitTestCase;
use PragmaGoTech\Interview\Validator\ValidationException;
use PragmaGoTech\Interview\Validator\AvailableTermsValidator;
use PragmaGoTech\Interview\Validator\MaximumValueValidator;
use PragmaGoTech\Interview\Validator\MinimumValueValidator;
use PragmaGoTech\Interview\Validator\Validator;

class ValidatorTest extends UnitTestCase
{
    #[Test]
    public function validateMultipleCriterias()
    {
        //given
        $givenWrongTermValue = 1;
        $givenWrongAmount = 1;
        $givenLoanProposal = new LoanProposal($givenWrongTermValue, $givenWrongAmount);
        $givenValidator = new Validator(new AvailableTermsValidator(), new MaximumValueValidator(20000), new MinimumValueValidator(1000));

        //expect
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Validation failed. Errors:\n- Currently loan for: \"1\" is not in out offer.\n- Value: \"1.000000\" is lower than minimal value: \"1000.000000\"");

        //when
        $givenValidator->validate($givenLoanProposal);
    }

    #[Test]
    public function correctValues()
    {
        //given
        $givenCorrectTermValue = 12;
        $givenCorrectAmount = 1500;
        $givenLoanProposal = new LoanProposal($givenCorrectTermValue, $givenCorrectAmount);
        $givenValidator = new Validator(new AvailableTermsValidator(), new MaximumValueValidator(20000), new MinimumValueValidator(1000));

        //expect
        $this->expectNotToPerformAssertions();

        //when
        $givenValidator->validate($givenLoanProposal);
    }
}