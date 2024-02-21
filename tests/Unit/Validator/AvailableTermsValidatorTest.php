<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Unit\Calculator;

use PHPUnit\Framework\Attributes\Test;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Tests\Common\UnitTestCase;
use PragmaGoTech\Interview\Validator\ValidationException;
use PragmaGoTech\Interview\Validator\AvailableTermsValidator;

class AvailableTermsValidatorTest extends UnitTestCase
{
    #[Test]
    public function wrongTerm()
    {
        //given
        $givenWrongTermValue = 1;
        $givenLoanProposal = new LoanProposal($givenWrongTermValue, 10000);
        $givenValidator = new AvailableTermsValidator();

        //expect
        $this->expectException(ValidationException::class);

        //when
        $givenValidator->validate($givenLoanProposal);
    }

    #[Test]
    public function correctTerm()
    {
        //given
        $givenCorrectTermValue = 12;
        $givenLoanProposal = new LoanProposal($givenCorrectTermValue, 10000);
        $givenValidator = new AvailableTermsValidator();

        //expect
        $this->expectNotToPerformAssertions();

        //when
        $givenValidator->validate($givenLoanProposal);
    }
}