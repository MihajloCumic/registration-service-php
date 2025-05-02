<?php
declare(strict_types=1);
namespace Src\service;

use Exception;

interface RegistrationService
{
    /**
     * @param string $email
     * @param string $pass
     * @return int
     * @throws Exception
     */
    public function registration(string $email, string $pass): int;
}