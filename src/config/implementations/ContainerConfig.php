<?php

namespace Src\config\implementations;

use Exception;
use Src\config\Provider;
use Src\container\Container;
use Src\database\DatabaseConnection;
use Src\database\DatabaseConnectionFactory;
use Src\dispatcher\Dispatcher;
use Src\dispatcher\impl\RequestDispatcher;
use Src\enums\HttpMethod;
use Src\exceptions\CustomException;
use Src\executor\Executor;
use Src\executor\factory\ControllerExecutorFactory;
use Src\request\adapter\PHPRequest;
use Src\request\Request;
use Src\routes\Routes;
use Src\service\impl\MaxMindServiceImpl;
use Src\service\impl\NotificationServiceImpl;
use Src\service\impl\RegistrationServiceImpl;
use Src\service\MaxMindService;
use Src\service\NotificationService;
use Src\service\RegistrationService;

class ContainerConfig implements Provider
{

    public function configure(Container $container): Container
    {
        try {
            $container->bind(DatabaseConnection::class, fn() => DatabaseConnectionFactory::getDatabaseConnection());
            $container->bind(RegistrationService::class, RegistrationServiceImpl::class);
            $container->bind(NotificationService::class, NotificationServiceImpl::class);
            $container->bind(MaxMindService::class, MaxMindServiceImpl::class);
            $container->bind(Routes::class, fn(Container $container) => (new RoutesConfig())->configure($container));
            $container->bind(Executor::class, fn(Container $container) => ControllerExecutorFactory::getControllerExecutor($container));
            $container->bind(Dispatcher::class, RequestDispatcher::class);
            $request = new PHPRequest(HttpMethod::POST, '/test', '127.0.0.1');
            $request->setBody([
                'email' => 'email@gmail.com',
                'password1' => '12345678',
                'password2' => '12345678'
            ]);
            $container->bind(Request::class, fn() => $request);
        } catch (Exception $e) {
            echo 'Something went wrong with binding.';
        } catch (CustomException $e) {
        }
        return $container;
    }
}