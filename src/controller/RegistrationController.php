<?php
declare(strict_types=1);
namespace Src\controller;

use Exception;
use Src\request\Request;
use Src\service\RegistrationService;

class RegistrationController
{
    public function __construct(private readonly RegistrationService $registrationService)
    {
    }

    /**
     * @throws Exception
     */
    public function registration(Request $request): array
    {
        $email = $request->getBody()['email'];
        $pass = $request->getBody()['password1'];
        $userId = $this->registrationService->registration($email, $pass);
        return [
            'success' => true,
            'userId' => $userId
        ];
    }
}