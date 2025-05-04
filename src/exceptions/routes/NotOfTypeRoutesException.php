<?php

namespace Src\exceptions\routes;

use Src\exceptions\CustomException;

class NotOfTypeRoutesException extends RoutesException
{

    public static function get(array $args): CustomException
    {
        $msg = "Object not of type Routes.";
        return new NotOfTypeRoutesException($msg);
    }
}