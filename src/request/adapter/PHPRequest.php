<?php
declare(strict_types=1);
namespace Src\request\adapter;

use Src\enums\HttpMethod;
use Src\request\Request;

class PHPRequest implements Request
{
    private ?array $body = null;
    public function __construct(private readonly HttpMethod $method, private readonly string $requestUri, private readonly string $userIpAddress)
    {
    }

    public function getRequestMethod(): HttpMethod
    {
        return $this->method;
    }

    public function getRequestUri(): string
    {
        return $this->requestUri;
    }

    public function getBody(): ?array
    {
        return $this->body;
    }

    public function setBody(?array $body): void
    {
        $this->body = $body;
    }


    public function getUserIpAddress(): string
    {
        return $this->userIpAddress;
    }
}