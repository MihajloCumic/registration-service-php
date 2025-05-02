<?php
declare(strict_types=1);
namespace Src\validation;

interface ValidationStrategy
{
    public function validate(mixed $value): ?string;
    public function getDefaultErrorMessage(): string;

}