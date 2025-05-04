<?php
declare(strict_types=1);
namespace Src\response;

use JetBrains\PhpStorm\NoReturn;

class Response
{
    public function __construct(public readonly array $body, public readonly int $statusCode = 200)
    {
    }

    #[NoReturn] public function send(): void
    {
        http_response_code($this->statusCode);
        echo json_encode($this->body);
        exit();
    }



}