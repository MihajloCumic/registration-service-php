<?php

namespace Src\validation;

interface Validator
{
    public function validate(array $data): bool;
    public function getErrors(): array;
}