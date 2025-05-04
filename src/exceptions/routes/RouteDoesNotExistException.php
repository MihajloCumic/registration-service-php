<?php

namespace Src\exceptions\routes;

use JetBrains\PhpStorm\NoReturn;
use Src\exceptions\CustomException;
use Src\response\Response;

class RouteDoesNotExistException extends RoutesException
{
    public static function get(array $args): CustomException
    {
        $methodName = $args[0] ?? '';
        $path = $args[1] ?? '';
        $msg = self::ROUTES_EXCEPTION . "Route for method {$methodName} and path {$path} does not exist.";
        return new RouteDoesNotExistException($msg);
    }

    #[NoReturn] public function send(): void
    {
        (new Response(['errorMessage' => $this->getMessage()], 404))->send();
    }
}