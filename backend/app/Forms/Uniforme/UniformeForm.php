<?php

namespace App\Forms\Uniforme;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class UniformeForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'temporada' => [new RequiredRule],
            'modelo_principal' => [new RequiredRule],
            'modelo_secundario' => [new RequiredRule],
            'time_id' => [
                new RequiredRule,
                new ExistsRule('times'),
            ],
        ];

        return new self($data, $rules);
    }
}
