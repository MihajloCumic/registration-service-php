<?php

namespace Src\exceptions\executor;

use Exception;
use Src\exceptions\CustomException;
use Throwable;

abstract class ExecutorException extends Exception implements CustomException
{
    protected const EXECUTOR_EXCEPTION = "Executor exception.\n";

    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}