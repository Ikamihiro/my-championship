<?php

namespace App\Forms\Auth;

use App\Forms\Rules\UniqueRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class RegisterForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'name' => [new RequiredRule],
            'email' => [
                new RequiredRule,
                new UniqueRule('users', 'email'),
            ],
            'document' => [new RequiredRule],
            'password' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
