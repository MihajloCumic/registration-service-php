<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use Src\exceptions\CustomException;
use Src\exceptions\validation\UserAlreadyExistsException;
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
     * @throws CustomException
     */
    public function handle(Request $request): Response
    {
        $email = $request->getBody()['email'];
        if($this->userRepository->doesUserWithEmailExist($email)){
            throw UserAlreadyExistsException::get([]);
        }
        return $this->next($request);
    }
}