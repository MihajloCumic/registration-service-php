<?php

namespace Src\exceptions\executor;

use Exception;

abstract class ExecutorException extends Exception
{
    protected const EXECUTOR_EXCEPTION = "Executor exception.\n";

    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    abstract public static function get(array $args): ExecutorException;
}