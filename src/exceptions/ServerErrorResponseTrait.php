<?php

namespace Src\exceptions;

use JetBrains\PhpStorm\NoReturn;
use Src\response\Response;

trait ServerErrorResponseTrait
{
    #[NoReturn] protected function sendServerError(): void
    {
        (new Response([], 500))->send();
    }
}