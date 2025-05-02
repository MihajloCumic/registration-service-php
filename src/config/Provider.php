<?php
declare(strict_types=1);
namespace Src\config;

use Src\container\Container;

interface Provider
{
    public function configure(Container $container): object;
}