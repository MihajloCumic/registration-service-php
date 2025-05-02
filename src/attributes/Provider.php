<?php
declare(strict_types=1);
namespace Src\attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Provider
{
    public function __construct(public string $providerClassName, public string $providedClassName)
    {
    }
}