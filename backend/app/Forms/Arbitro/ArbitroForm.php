<?php

namespace App\Forms\Arbitro;

use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class ArbitroForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'data_nascimento' => [new RequiredRule],
            'tipo' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
