<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use Src\attributes\Provider;
use Src\config\implementations\RegistrationValidatorConfig;
use Src\handler\RequestHandler;
use Src\request\Request;
use Src\response\Response;
use Src\validation\orchestrator\Validator;

#[Provider(RegistrationValidatorConfig::class, Validator::class)]
class RegistrationValidationHandler extends RequestHandler
{
    public function __construct(private readonly Validator $validator)
    {
    }


    /**
     * @throws Exception
     */
    public function handle(Request $request): Response
    {
        if($request->getBody() === null){
            return new Response([
                'success' => false,
                'errorMessage' => 'Body is not set on request.'
            ], 400);
        }
        $res = $this->validator->validate($request->getBody());
        if(!$res){
            return new Response([
                'success' => false,
                'errorMessage' => $this->validator->getErrors()
            ], 400);
        }
        return $this->next($request);
    }
}