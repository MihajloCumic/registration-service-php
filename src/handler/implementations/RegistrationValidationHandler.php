<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use Src\attributes\Provider;
use Src\config\implementations\RegistrationValidatorConfig;
use Src\exceptions\CustomException;
use Src\exceptions\validation\BodyNotSetException;
use Src\exceptions\validation\ValidationException;
use Src\handler\RequestHandler;
use Src\request\Request;
use Src\response\Response;
use Src\validation\FieldValidator;
use Src\validation\Validator;

#[Provider(RegistrationValidatorConfig::class, Validator::class)]
class RegistrationValidationHandler extends RequestHandler
{
    public function __construct(private readonly FieldValidator $validator)
    {
    }


    /**
     * @throws Exception
     * @throws CustomException
     */
    public function handle(Request $request): Response
    {
        if($request->getBody() === null){
            throw BodyNotSetException::get([]);
        }
        $res = $this->validator->validate($request->getBody());
        if(!$res){
            throw ValidationException::get($this->validator->getErrors());
        }
        return $this->next($request);
    }
}