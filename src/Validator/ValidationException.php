<?php

declare (strict_types=1);

namespace PragmaGoTech\Interview\Validator;

use Throwable;
use LogicException;

final class ValidationException extends LogicException {
    public function __construct($message = "Validation failed", $code = 403, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}