<?php

namespace Src\exceptions;

use Exception;
use JetBrains\PhpStorm\NoReturn;

class ExceptionManager implements Manager
{
    use ServerErrorResponseTrait;
    #[NoReturn] public function resolve(Exception $e): void
    {
        if($e instanceof CustomException){
            $e->send();
        }
        $this->sendServerError();
        //Logger
    }

    public static function getExceptionManager(): Manager
    {
        return new ExceptionManager();
    }
}