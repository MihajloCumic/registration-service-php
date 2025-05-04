<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use Src\exceptions\CustomException;
use Src\exceptions\validation\MatchingPasswordsException;
use Src\exceptions\validation\ValidationException;
use Src\handler\RequestHandler;
use Src\request\Request;
use Src\response\Response;

class MatchingPasswordsHandler extends RequestHandler
{

    /**
     * @throws Exception
     * @throws CustomException
     */
    public function handle(Request $request): Response
    {
        $password1 = $request->getBody()['password1'];
        $password2 = $request->getBody()['password2'];
        if($password1 !== $password2){
            throw MatchingPasswordsException::get([]);
        }
        return $this->next($request);
    }
}