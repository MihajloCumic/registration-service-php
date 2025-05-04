<?php

namespace Src\exceptions\validation;

use Src\exceptions\CustomException;

class BodyNotSetException extends ValidationException
{
    public static function get(array $args): CustomException
    {
        return new BodyNotSetException(self::VALIDATION_EXCEPTION . "Body must be set.");
    }

}