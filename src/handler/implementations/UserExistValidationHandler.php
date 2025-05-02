<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use Src\handler\RequestHandler;
use Src\repository\implementations\UserRepository;
use Src\request\Request;
use Src\response\Response;

class UserExistValidationHandler extends RequestHandler
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(Request $request): Response
    {
        $email = $request->getBody()['email'];
        if($this->userRepository->doesUserWithEmailExist($email)){
            return new Response([
                'success' => false,
                'errorMessage' => 'User already exists'
            ], 400);
        }
        return $this->next($request);
    }
}