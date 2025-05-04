<?php

namespace Src\exceptions\container;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use Src\exceptions\CustomException;
use Src\exceptions\ServerErrorResponseTrait;
use Throwable;

abstract class ContainerException extends Exception implements CustomException
{
    use ServerErrorResponseTrait;
    protected const CONTAINER_EXCEPTION = "Container exception.\n";

    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    #[NoReturn] public function send(): void
    {
        $this->sendServerError();
    }


}