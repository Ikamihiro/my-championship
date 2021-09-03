<?php

namespace Lib\Validation\Rules;

use Lib\Validation\Rule;

class RequiredRule extends Rule
{
    public function validate($field): bool
    {
        $validation = isset($field);

        if (!$validation) {
            $this->setError("Value cannot be null!");
        }

        return $validation;
    }
}
