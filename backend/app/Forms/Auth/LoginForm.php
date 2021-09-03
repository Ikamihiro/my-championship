<?php

namespace App\Forms\Auth;

use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class LoginForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'email' => [new RequiredRule],
            'password' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
