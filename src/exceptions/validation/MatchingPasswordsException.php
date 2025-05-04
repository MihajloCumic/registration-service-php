<?php

namespace Src\exceptions\validation;

use Src\exceptions\CustomException;

class MatchingPasswordsException extends ValidationException
{
    public static function get(array $args): CustomException
    {
        return new MatchingPasswordsException('Passwords must be the same.');
    }

}