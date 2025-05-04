<?php

namespace Src\exceptions\container;

use Exception;
use Src\exceptions\CustomException;
use Throwable;

abstract class ContainerException extends Exception implements CustomException
{
    protected const CONTAINER_EXCEPTION = "Container exception.\n";

    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}