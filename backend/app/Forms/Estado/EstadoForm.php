<?php

namespace App\Forms\Estado;

use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class EstadoForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'sigle' => [new RequiredRule]
        ];

        return new self($data, $rules);
    }
}
