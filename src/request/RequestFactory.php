<?php
declare(strict_types=1);
namespace Src\request;

use Src\enums\HttpMethod;
use Src\request\adapter\PHPRequest;

class RequestFactory
{
    public static function getPHPRequest(): Request
    {
        $methodString = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $method = HttpMethod::from($methodString);

        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';

        $userIpAddress = $_SERVER['REMOTE_ADDR'] ?? '';

        $request = new PHPRequest($method, $requestUri, $userIpAddress);

        $rawBody = file_get_contents('php://input');
        if($rawBody){
            $body = json_decode($rawBody, true);
            $request->setBody($body);
        }
        return $request;
    }
}