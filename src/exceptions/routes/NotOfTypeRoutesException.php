<?php

namespace Src\exceptions\routes;

use JetBrains\PhpStorm\NoReturn;
use Src\exceptions\CustomException;
use Src\exceptions\ServerErrorResponseTrait;

class NotOfTypeRoutesException extends RoutesException
{
    use ServerErrorResponseTrait;

    public static function get(array $args): CustomException
    {
        $msg = "Object not of type Routes.";
        return new NotOfTypeRoutesException($msg);
    }

    #[NoReturn] public function send(): void
    {
        $this->sendServerError();
    }
}