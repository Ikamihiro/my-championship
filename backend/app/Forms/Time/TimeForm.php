<?php

namespace App\Forms\Time;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class TimeForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'ano_fundacao' => [new RequiredRule],
            'cidade_id' => [
                new RequiredRule,
                new ExistsRule('cidades'),
            ],
        ];

        return new self($data, $rules);
    }
}
