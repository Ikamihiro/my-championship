<?php

namespace App\Forms\User;

use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class RegisterForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'name' => [new RequiredRule],
            'email' => [new RequiredRule],
            'document' => [new RequiredRule],
            'password' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
