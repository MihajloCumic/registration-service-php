<?php

namespace Src\executor\factory;

use Src\container\Container;
use Src\executor\Executor;
use Src\executor\impl\ControllerExecutor;

class ControllerExecutorFactory
{
    public static function getControllerExecutor(Container $container): Executor
    {
        return new ControllerExecutor($container);
    }
}