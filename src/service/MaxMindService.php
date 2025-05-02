<?php
declare(strict_types=1);
namespace Src\service;

use CurlHandle;
use Src\request\Request;

interface MaxMindService
{
    public function areEmailAndAddressFraud(Request $request): bool;

}