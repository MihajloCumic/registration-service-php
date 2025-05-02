<?php

namespace Src\validation\strategy;

use Src\validation\ValidationStrategy;

class NotBlankStrategy implements ValidationStrategy
{

    public function validate(mixed $value): ?string
    {
        if(trim($value) === ''){
            return $this->getDefaultErrorMessage();
        }
        return null;
    }

    public function getDefaultErrorMessage(): string
    {
        return 'String must not be blank.';
    }
}