<?php

namespace Src\exceptions\validation;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use Src\exceptions\CustomException;
use Src\response\Response;

class ValidationException extends Exception implements CustomException
{
    protected const VALIDATION_EXCEPTION = "Validation Exception.\n";

    public static function get(array $args): CustomException
    {
        $errors = [];
        foreach($args as $fieldName => $messages){
            if(is_array($messages) && !empty($messages)){
                $msgString = implode(", ", $messages);
                $errors[] = "${fieldName} errors: " . $msgString;
            }
        }
        $errorStr = implode("\n", $errors);
        return new ValidationException(self::VALIDATION_EXCEPTION . $errorStr);
    }

    #[NoReturn] public function send(): void
    {
        (new Response(['errorMessage' => $this->getMessage()], 400))->send();
    }
}