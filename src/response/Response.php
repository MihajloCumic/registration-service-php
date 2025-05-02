<?php
declare(strict_types=1);
namespace Src\response;

class Response
{
    public function __construct(public readonly array $body, public readonly int $statusCode)
    {
    }

    public function send(): void
    {
        echo json_encode($this->body);
    }



}