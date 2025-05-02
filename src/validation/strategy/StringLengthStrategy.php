<?php
declare(strict_types=1);
namespace Src\validation\strategy;

use Src\validation\ValidationStrategy;

class StringLengthStrategy implements ValidationStrategy
{

    public function __construct(private readonly int $min = 0, private readonly ?int $max = null)
    {
    }

    public function validate(mixed $value): ?string
    {
        $len = strlen((string)$value);

        if($len < $this->min || ($this->max !== null && $len > $this->max)){
            return $this->getDefaultErrorMessage();
        }
        return null;


    }

    public function getDefaultErrorMessage(): string
    {
        $message = "String must be more than: {$this->min}";
        if($this->max !== null){
            $message .= " and less than {$this->max}";
        }
        $message .= ' characters long';
        return $message;
    }
}