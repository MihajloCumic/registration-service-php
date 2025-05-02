<?php
declare(strict_types=1);
namespace Src\service\impl;

use Src\service\NotificationService;

class NotificationServiceImpl implements NotificationService
{
    private readonly string $senderEmail;

    public function __construct()
    {
        $this->senderEmail = $_ENV["SENDER_EMAIL"];
    }

    private function notify(string $receiverEmail, string $subject, string $body, string $headers): bool
    {
        return mail($receiverEmail, $subject, $body, $headers);
    }

    public function notifyEmailConfirmation(string $receiverEmail): bool
    {
        $subject = 'Dobro došli';
        $body = 'Dobro dosli na nas sajt. Potrebno je samo da potvrdite email adresu ...';
        $headers = 'From: '. $this->senderEmail . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        return $this->notify($receiverEmail, $subject, $body, $headers);
    }
}