<?php
declare(strict_types=1);
namespace Src\app;

use ReflectionException;
use Src\config\implementations\ContainerConfig;
use Src\container\Container;
use Src\dispatcher\Dispatcher;
use Src\exceptions\CustomException;

class Application
{
    private readonly Container $container;
    public function __construct(ContainerConfig $containerProvider)
    {
        $this->container = $containerProvider->configure(new Container());;
    }

    public function execute(): void
    {
        try {
            $dispatcher = $this->container->get(Dispatcher::class);
            if($dispatcher instanceof Dispatcher){
                $dispatcher->dispatch();
            }
        } catch (ReflectionException|CustomException $e) {
            echo $e->getMessage();
        }
    }


}