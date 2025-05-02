<?php
declare(strict_types=1);
namespace Src\validation\strategy;

use Src\validation\ValidationStrategy;

class EmailStrategy implements ValidationStrategy
{

    public function validate(mixed $value): ?string
    {
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
            return $this->getDefaultErrorMessage();
        }
        return null;
    }

    public function getDefaultErrorMessage(): string
    {
        return 'Email is not valid.';
    }
}