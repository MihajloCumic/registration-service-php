<?php

namespace Src\exceptions;

use JetBrains\PhpStorm\NoReturn;
use Src\response\Response;

trait ServerErrorResponseTrait
{
    #[NoReturn] protected function sendServerError(): void
    {
        (new Response(['errorMessage' => 'Internal Server Error.'], 500))->send();
    }
}