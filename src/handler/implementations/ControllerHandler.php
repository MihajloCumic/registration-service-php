<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use Src\container\Container;
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

    public function handle(Request $request): Response
    {
        try {
            $executor = $this->container->get(Executor::class);
            if($executor instanceof Executor){
                $res = $executor->execute($this->controllerClassName, $this->controllerMethodName, [$request]);
                return new Response($res, 200);
            }
        } catch (Exception $e) {
            return new Response([
                'success' => false,
                'errorMessage' => 'Could not register user.'
            ], 500);
        }
        return new Response([
            'success' => false,
            'errorMessage' => 'executor is not Executor in ControllerHanlder.'
        ], 500);
    }
}