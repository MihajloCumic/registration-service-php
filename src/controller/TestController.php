<?php

namespace Src\controller;

use Src\request\Request;

class TestController
{
    public function getTest(Request $request): array
    {
        return [
            'email' => $request->getBody()['email'],
            'password1' => $request->getBody()['password1'],
            'password2' => $request->getBody()['password2']
        ];
    }

}