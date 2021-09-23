<?php

namespace App\Forms\ComissaoTecnica;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class ComissaoTecnicaForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'time_id' => [
                new RequiredRule,
                new ExistsRule('times'),
            ],
        ];

        return new self($data, $rules);
    }
}
