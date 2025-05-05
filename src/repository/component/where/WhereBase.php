<?php
declare(strict_types=1);
namespace Src\repository\component\where;

class WhereBase
{
    public function __construct(private readonly string $val)
    {
    }

    public function where(string $val): Where
    {
        return new Where($this->val . ' WHERE ' . $val);
    }

    public function build(): string
    {
        return trim($this->val);
    }

}