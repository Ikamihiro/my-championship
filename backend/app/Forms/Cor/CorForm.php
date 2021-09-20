<?php

namespace App\Forms\Cor;

use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class CorForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'hex' => [new RequiredRule]
        ];

        return new self($data, $rules);
    }
}
