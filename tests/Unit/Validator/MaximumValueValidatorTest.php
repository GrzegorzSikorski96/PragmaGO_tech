<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Unit\Calculator;

use PHPUnit\Framework\Attributes\Test;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Tests\Common\UnitTestCase;
use PragmaGoTech\Interview\Validator\ValidationException;
use PragmaGoTech\Interview\Validator\MaximumValueValidator;

class MaximumValueValidatorTest extends UnitTestCase
{
    #[Test]
    public function wrongAmount()
    {
        //given
        $givenWrongAmountValue = 20001;
        $givenLoanProposal = new LoanProposal(12, $givenWrongAmountValue);
        $givenValidator = new MaximumValueValidator(20000);

        //expect
        $this->expectException(ValidationException::class);

        //when
        $givenValidator->validate($givenLoanProposal);
    }

    #[Test]
    public function correctAmount()
    {
        //given
        $givenCorrectAmountValue = 20000;
        $givenLoanProposal = new LoanProposal(12, $givenCorrectAmountValue);
        $givenValidator = new MaximumValueValidator(20000);

        //expect
        $this->expectNotToPerformAssertions();

        //when
        $givenValidator->validate($givenLoanProposal);
    }
}