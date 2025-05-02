<?php
declare(strict_types=1);
namespace Src\dispatcher;

interface Dispatcher
{
    public function dispatch(): void;

}