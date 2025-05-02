<?php

namespace Src\config\implementations;

use Src\config\Provider;
use Src\container\Container;
use Src\controller\RegistrationController;
use Src\controller\TestController;
use Src\enums\HttpMethod;
use Src\handler\implementations\MatchingPasswordsHandler;
use Src\handler\implementations\MaxMindValidationHandler;
use Src\handler\implementations\RegistrationValidationHandler;
use Src\handler\implementations\UserExistValidationHandler;
use Src\routes\Routes;

class RoutesConfig implements Provider
{
    public function configure(Container $container): Routes
    {
        $handlers = [
            RegistrationValidationHandler::class,
            //MaxMindValidationHandler::class,
            MatchingPasswordsHandler::class,
            //UserExistValidationHandler::class,
        ];

        $controllerName = TestController::class;
        $controllerMethodName = 'getTest';

        return  (new Routes())->addRoute(HttpMethod::POST, '/test', $handlers, $controllerName, $controllerMethodName);
    }
}