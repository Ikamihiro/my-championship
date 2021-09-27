<?php

namespace App\Forms\Arbitragem;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class ArbitragemForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'partida_id' => [
                new RequiredRule,
                new ExistsRule('partidas'),
            ],
        ];

        return new self($data, $rules);
    }
}
