<?php
declare(strict_types=1);
namespace Src\exceptions\routes;

use Exception;

abstract class RoutesException extends Exception
{
    protected const ROUTES_EXCEPTION = "Routes exception.\n";

    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}