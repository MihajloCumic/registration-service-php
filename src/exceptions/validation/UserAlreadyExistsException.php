<?php

namespace Src\exceptions\validation;

use JetBrains\PhpStorm\NoReturn;
use Src\exceptions\CustomException;
use Src\response\Response;

class UserAlreadyExistsException extends ValidationException
{
    public static function get(array $args): CustomException
    {
        return new UserAlreadyExistsException(self::VALIDATION_EXCEPTION . 'User already exists.');
    }

    #[NoReturn] public function send(): void
    {
        (new Response(['errorMessage' => $this->getMessage()], 409))->send();
    }


}