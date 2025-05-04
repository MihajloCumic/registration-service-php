<?php

namespace Src\exceptions\routes;

use Src\exceptions\CustomException;

class RouteDoesNotExistException extends RoutesException
{
    public static function get(array $args): CustomException
    {
        $methodName = $args[0] ?? '';
        $path = $args[1] ?? '';
        $msg = self::ROUTES_EXCEPTION . "Route for method {$methodName} and path {$path} does not exist.";
        return new RouteDoesNotExistException($msg);
    }
}