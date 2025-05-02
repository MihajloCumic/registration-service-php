<?php
declare(strict_types=1);
namespace Src\service;

interface NotificationService
{
    public function notifyEmailConfirmation(string $receiverEmail): bool;
}