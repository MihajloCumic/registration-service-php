<?php

namespace Src\exceptions;

interface CustomException
{
    public static function get(array $args): CustomException;
}