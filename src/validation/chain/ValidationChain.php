<?php
declare(strict_types=1);
namespace Src\validation\chain;

use Src\validation\ValidationStrategy;

class ValidationChain
{
    /**
     * @var array<ValidationStrategy>
     */
    private array $strategies = [];

    public function addStrategy(ValidationStrategy $strategy): self
    {
        $this->strategies[] = $strategy;
        return $this;
    }

    public function validateAndCollect(mixed $value): array
    {
        $errors = [];
        foreach ($this->strategies as $strategy){
            $error = $strategy->validate($value);
            $errors[] = $error;
        }
        return array_filter($errors);
    }
}