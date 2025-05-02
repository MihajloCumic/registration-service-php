<?php

namespace Src\validation\strategy;

use Src\validation\ValidationStrategy;

class StringStrategy implements ValidationStrategy
{

    public function validate(mixed $value): ?string
    {
        if(is_string($value)){
            return null;
        }
        return $this->getDefaultErrorMessage();
    }

    public function getDefaultErrorMessage(): string
    {
        return 'Value should be a string, but it is not.';
    }
}