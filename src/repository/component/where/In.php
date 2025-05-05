<?php

namespace Src\repository\component\where;

class In
{
    public function __construct(private readonly string $val)
    {
    }

    public function and(string $val): AndExpression
    {
        return new AndExpression($this->val . ' ANd ' . $val);
    }

    public function build(): string
    {
        return $this->val;
    }
}