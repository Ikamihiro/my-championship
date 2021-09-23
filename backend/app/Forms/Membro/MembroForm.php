<?php

namespace App\Forms\Membro;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class MembroForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'funcao' => [new RequiredRule],
            'data_admissao' => [new RequiredRule],
            'comissao_id' => [
                new RequiredRule,
                new ExistsRule('comissoes_tecnicas'),
            ],
        ];

        return new self($data, $rules);
    }
}
