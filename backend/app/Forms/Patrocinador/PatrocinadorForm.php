<?php

namespace App\Forms\Patrocinador;

use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class PatrocinadorForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
