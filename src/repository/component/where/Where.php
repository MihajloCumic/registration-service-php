<?php

namespace Src\repository\component\where;

use Src\repository\component\SQLExpression;

class Where
{
    public function __construct(private readonly string $val)
    {
    }

    public function like(string $val): Like
    {
        return new Like($this->val . ' LIKE ' . $val);
    }

    public function in(SQLExpression $expression): In
    {
        return new In($this->val . ' IN ' . $expression->getExpression());
    }
}