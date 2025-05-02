<?php
declare(strict_types=1);
namespace Src\validation\strategy;

use Src\validation\ValidationStrategy;

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