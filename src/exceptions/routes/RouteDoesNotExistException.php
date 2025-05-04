<?php

namespace Src\exceptions\routes;

class RouteDoesNotExistException extends RoutesException
{
    public static function getRouteDoesNotExistException(string $methodName, string $path): RoutesException
    {
        $msg = self::ROUTES_EXCEPTION . "Route for method {$methodName} and path {$path} does not exist.";
        return new RouteDoesNotExistException($msg);
    }
}