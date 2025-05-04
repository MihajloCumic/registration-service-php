<?php

namespace Src\exceptions;

use Exception;

class ExceptionManager implements Manager
{
    public function resolve(Exception $e): void
    {
        if($e instanceof CustomException){
            $e->send();
        }
    }

    public static function getExceptionManager(): Manager
    {
        return new ExceptionManager();
    }
}