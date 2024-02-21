<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Unit\Calculator;

use PHPUnit\Framework\Attributes\Test;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Tests\Common\UnitTestCase;
use PragmaGoTech\Interview\Validator\ValidationException;
use PragmaGoTech\Interview\Validator\MinimumValueValidator;

class MinimumValueValidatorTest extends UnitTestCase
{
    #[Test]
    public function wrongAmount()
    {
        //given
        $givenWrongAmountValue = 999;
        $givenLoanProposal = new LoanProposal(12, $givenWrongAmountValue);
        $givenValidator = new MinimumValueValidator(1000);

        //expect
        $this->expectException(ValidationException::class);

        //when
        $givenValidator->validate($givenLoanProposal);
    }

    #[Test]
    public function correctAmount()
    {
        //given
        $givenCorrectAmountValue = 1000;
        $givenLoanProposal = new LoanProposal(12, $givenCorrectAmountValue);
        $givenValidator = new MinimumValueValidator(1000);

        //expect
        $this->expectNotToPerformAssertions();

        //when
        $givenValidator->validate($givenLoanProposal);
    }
}