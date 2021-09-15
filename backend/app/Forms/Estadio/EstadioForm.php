<?php

namespace App\Forms\Estado;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class EstadioForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'capacidade_total' => [new RequiredRule],
            'data_construcao' => [new RequiredRule],
            'time_id' => [
                new RequiredRule,
                new ExistsRule('times'),
            ],
        ];

        return new self($data, $rules);
    }
}
