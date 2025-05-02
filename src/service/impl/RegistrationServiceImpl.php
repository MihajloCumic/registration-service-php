<?php
declare(strict_types=1);
namespace Src\service\impl;

use Exception;
use Src\repository\implementations\UserLogRepository;
use Src\repository\implementations\UserRepository;
use Src\service\NotificationService;
use Src\service\RegistrationService;

class RegistrationServiceImpl implements RegistrationService
{

    public function __construct(private readonly UserRepository $userRepository, private readonly NotificationService $notificationService, private readonly UserLogRepository $userLogRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function registration(string $email, string $pass): int
    {
        $id = $this->userRepository->create($email, $pass);
        $this->notificationService->notifyEmailConfirmation($email);
        $this->userLogRepository->create($id, 'register');
        $_SESSION['userId'] = $id;
        return $id;
    }
}