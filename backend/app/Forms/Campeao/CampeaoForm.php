<?php

namespace App\Forms\Campeao;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class CampeaoForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'time_id' => [
                new RequiredRule,
                new ExistsRule('times'),
            ],
            'campeonato_id' => [
                new RequiredRule,
                new ExistsRule('campeonatos'),
            ],
        ];

        return new self($data, $rules);
    }
}
