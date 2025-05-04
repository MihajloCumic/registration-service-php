<?php
declare(strict_types=1);
namespace Src\exceptions\routes;

use Exception;
use Src\exceptions\CustomException;
use Throwable;

abstract class RoutesException extends Exception implements CustomException
{
    protected const ROUTES_EXCEPTION = "Routes exception.\n";

    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}