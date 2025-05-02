<?php
declare(strict_types=1);
namespace Src\repository;

class SQLExpression
{
    public function __construct(private readonly string $expression)
    {
    }

    public function __toString(): string
    {
        return $this->expression;
    }

    public function getExpression(): string
    {
        return $this->expression;
    }
}