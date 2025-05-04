<?php

namespace Src\exceptions;

use Exception;

interface Manager
{
    public function resolve(Exception $e): void;
}