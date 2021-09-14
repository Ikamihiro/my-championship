<?php

namespace App\Forms\Presidente;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class PresidenteForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'mandato_inicio' => [new RequiredRule],
            'mandato_fim' => [new RequiredRule],
            'time_id' => [
                new RequiredRule,
                new ExistsRule('times'),
            ],
        ];

        // TODO: validar se o Time já possui um presidente

        return new self($data, $rules);
    }
}