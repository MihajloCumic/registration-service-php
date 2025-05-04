<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use ReflectionException;
use Src\container\Container;
use Src\exceptions\CustomException;
use Src\executor\Executor;
use Src\executor\factory\ControllerExecutorFactory;
use Src\handler\RequestHandler;
use Src\request\Request;
use Src\response\Response;

class ControllerHandler extends RequestHandler
{
    public function __construct(private readonly Container $container,
                                private readonly string $controllerClassName,
                                private readonly string $controllerMethodName)
    {
    }

    /**
     * @throws CustomException
     * @throws ReflectionException
     * @throws Exception
     */
    public function handle(Request $request): Response
    {
        $executor = $this->container->get(Executor::class);
        if($executor instanceof Executor){
            $res = $executor->execute($this->controllerClassName, $this->controllerMethodName, [$request]);
            return new Response($res, 200);
        }
        throw new Exception("Controller handler: Not of type Executor.");
    }
}