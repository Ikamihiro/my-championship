<?php

namespace App\Forms\User;

use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class CreateUserForm extends Form
{
    public static function create(array $data)
    {
        $rules = [
            'name' => [new RequiredRule],
            'email' => [new RequiredRule],
            'document' => [new RequiredRule],
            'senha' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
