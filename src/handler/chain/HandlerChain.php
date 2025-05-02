<?php

namespace Src\handler\chain;

use Exception;
use Src\handler\Handler;
use Src\request\Request;
use Src\response\Response;

class HandlerChain
{
    private ?Handler $firstHandler = null;
    private ?Handler $lastHandler = null;

    public function addHandler(Handler $handler): self
    {
        if($this->firstHandler === null && $this->lastHandler === null){
            $this->firstHandler = $handler;
            $this->lastHandler = $handler;
            return $this;
        }
        $this->lastHandler = $this->lastHandler->setNext($handler);
        return $this;
    }

    /**
     * @throws Exception
     */
    public function handle(Request $request): Response
    {
        if($this->firstHandler === null){
            throw new Exception("First handler is null.");
        }
        return $this->firstHandler->handle($request);
    }

}