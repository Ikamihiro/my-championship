<?php

namespace App\Forms\Campeonato;

use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class CampeonatoForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'temporada' => [new RequiredRule],
            'tipo' => [new RequiredRule],
            'premiacao_valor' => [new RequiredRule],
        ];

        return new self($data, $rules);
    }
}
