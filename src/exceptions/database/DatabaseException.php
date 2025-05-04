<?php
declare(strict_types=1);
namespace Src\exceptions\database;

use Exception;

class DatabaseException extends Exception
{
    protected const DATABASE_EXCEPTION = "Database exception.\n";

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}