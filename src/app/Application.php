<?php
declare(strict_types=1);
namespace Src\app;

use Dotenv\Dotenv;
use Exception;
use Src\config\implementations\ContainerConfig;
use Src\container\Container;
use Src\dispatcher\Dispatcher;
use Src\exceptions\CustomException;
use Src\exceptions\Manager;

class Application
{
    private readonly Container $container;
    public function __construct(ContainerConfig $containerProvider, private readonly Manager $exceptionManager)
    {
        try {
            $this->container = $containerProvider->configure(new Container());
        } catch (Exception|CustomException $e) {
            $this->exceptionManager->resolve($e);
        }
    }

    public function execute(): void
    {
        $this->loadEnv();
        try {
            $dispatcher = $this->container->get(Dispatcher::class);
            if($dispatcher instanceof Dispatcher){
                $dispatcher->dispatch();
            }
        } catch (Exception|CustomException $e) {
            $this->exceptionManager->resolve($e);
        }
    }

    private function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }


}