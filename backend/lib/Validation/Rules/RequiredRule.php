<?php

namespace Lib\Validation\Rules;

use Lib\Validation\Rule;

class RequiredRule extends Rule
{
    public function validate($field): bool
    {
        $validation = isset($field) && !empty($field);

        if (!$validation) {
            $this->setError("Campo obrigatório!");
        }

        return $validation;
    }
}
