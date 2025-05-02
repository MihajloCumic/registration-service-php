<?php
declare(strict_types=1);
namespace Src\request;

use Src\enums\HttpMethod;

interface Request
{
    public function getRequestMethod(): HttpMethod;
    public function getRequestUri(): string;

    public function getBody(): ?array;

    public function getUserIpAddress(): string;
}