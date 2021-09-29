<?php

namespace App\Forms\Cor;

use App\Rules\ExistsRule;
use Lib\Validation\Form;
use Lib\Validation\Rules\RequiredRule;

class CorForm extends Form
{
    public static function make(array $data)
    {
        $rules = [
            'nome' => [new RequiredRule],
<<<<<<< HEAD
=======
            'hex' => [new RequiredRule],
>>>>>>> f134d41382512019b93677d74b9a9162df4030f8
        ];

        return new self($data, $rules);
    }
}
