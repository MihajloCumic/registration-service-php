<?php

namespace Src\handler;

use Src\request\Request;
use Src\response\Response;

interface Handler
{
    public function setNext(Handler $handler): Handler;
    public function handle(Request $request): Response;
}