<?php

namespace Src\exceptions\container;

use Exception;
use Throwable;

abstract class ContainerException extends Exception
{
    protected const CONTAINER_EXCEPTION = "Container exception.\n";

    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    abstract public static function get(array $args): ContainerException;
}