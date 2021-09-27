<?php

namespace App\Forms\Plantel;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class PlantelForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'temporada' => [new RequiredRule],
            'time_id' => [
                new RequiredRule,
                new ExistsRule('times'),
            ],
        ];

        return new self($data, $rules);
    }
}