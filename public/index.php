<?php
declare(strict_types=1);

use Src\app\Application;
use Src\config\implementations\ContainerConfig;
use Src\enums\HttpMethod;
use Src\request\adapter\PHPRequest;

require_once __DIR__ . '/../vendor/autoload.php';

$request = new PHPRequest(HttpMethod::POST, '/test', '127.0.0.1');
$request->setBody([
    'email' => 'email@gmail.com',
    'password1' => '12345678',
    'password2' => '12345678'
]);
$app = new Application(new ContainerConfig());

$app->execute();

