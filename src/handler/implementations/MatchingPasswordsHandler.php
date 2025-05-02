<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use Src\handler\RequestHandler;
use Src\request\Request;
use Src\response\Response;

class MatchingPasswordsHandler extends RequestHandler
{

    /**
     * @throws Exception
     */
    public function handle(Request $request): Response
    {
        $password1 = $request->getBody()['password1'] ?? null;
        $password2 = $request->getBody()['password2'] ?? null;
        if($password1 === null || $password2 === null){
            return new Response([
                'success' => false,
                'errorMessage' => 'password1 or password2 not set.'
            ], 400);
        }
        if($password1 !== $password2){
            return new Response([
                'success' => false,
                'errorMessage' => 'Passwords must be the same.'
            ], 400);
        }

        return $this->next($request);
    }
}