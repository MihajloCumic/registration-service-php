<?php
declare(strict_types=1);

use Src\app\Application;
use Src\config\implementations\ContainerConfig;
use Src\exceptions\ExceptionManager;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(new ContainerConfig(), ExceptionManager::getExceptionManager());

$app->execute();

