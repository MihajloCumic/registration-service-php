<?php

namespace Src\executor;

interface Executor
{
    public function execute(string $className, string $methodName, array $args);
}