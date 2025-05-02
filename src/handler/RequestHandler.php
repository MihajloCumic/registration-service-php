<?php
declare(strict_types=1);
namespace Src\handler;

use Exception;
use Src\request\Request;
use Src\response\Response;

abstract class RequestHandler implements Handler
{
    protected ?Handler $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    /**
     * @throws Exception
     */
    protected function next(Request $request): Response
    {
        if($this->nextHandler === null){
            throw new Exception("Unexpected end of handler chain.");
        }
        return $this->nextHandler->handle($request);
    }

    abstract public function handle(Request $request): Response;
}