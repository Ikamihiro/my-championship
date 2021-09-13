<?php

namespace App\Forms\Cidade;

use App\Forms\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class CidadeForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
            'estado_id' => [new RequiredRule, new ExistsRule('estados')]
        ];

        return new self($data, $rules);
    }
}
