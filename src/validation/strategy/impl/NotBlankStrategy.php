<?php

namespace Src\validation\strategy\impl;

use Src\validation\strategy\ValidationStrategy;

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