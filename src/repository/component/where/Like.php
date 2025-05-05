<?php

namespace Src\repository\component\where;

class Like
{
    public function __construct(private readonly string $val)
    {
    }

    public function and(string $val): AndExpression
    {
        return new AndExpression($this->val . ' AND ' . $val);
    }

    public function build(): string
    {
        return trim($this->val);
    }
}