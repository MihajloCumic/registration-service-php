<?php

namespace Src\routes;

class Route
{
    public function __construct(public readonly array $handlerNames,
                                public readonly string $controllerName,
                                public readonly string $controllerMethodName)
    {
    }

}