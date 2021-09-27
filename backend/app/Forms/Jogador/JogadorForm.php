<?php

namespace App\Forms\Jogador;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class JogadorForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'temporada' => [new RequiredRule],
            'data_admissao' => [new RequiredRule],
            'posicao' => [new RequiredRule],
            'data_nascimento' => [new RequiredRule]
        ];

        return new self($data, $rules);
    }
}
