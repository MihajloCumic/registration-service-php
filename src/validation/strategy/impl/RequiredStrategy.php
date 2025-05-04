<?php
declare(strict_types=1);
namespace Src\validation\strategy\impl;

use Src\validation\strategy\ValidationStrategy;

class RequiredStrategy implements ValidationStrategy
{

    public function validate(mixed $value): ?string
    {
        if($value === null){
            return $this->getDefaultErrorMessage();
        }
        return null;
    }

    public function getDefaultErrorMessage(): string
    {
        return 'Field is not set.';
    }
}