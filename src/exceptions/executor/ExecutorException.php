<?php

namespace Src\exceptions\executor;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use Src\exceptions\CustomException;
use Src\exceptions\ServerErrorResponseTrait;
use Throwable;

abstract class ExecutorException extends Exception implements CustomException
{
    use ServerErrorResponseTrait;
    protected const EXECUTOR_EXCEPTION = "Executor exception.\n";

    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    #[NoReturn] public function send(): void
    {
        $this->sendServerError();
    }


}