<?php

namespace App\Rules;

use Lib\Validation\Rule;
use Illuminate\Database\Capsule\Manager as Database;

class ExistsRule extends Rule
{
    public string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function validate($field): bool
    {
        $result = Database::table($this->table)->find($field);

        if (is_null($result)) {
            $this->setError('Record not exists in database!');
        }

        return !is_null($result);
    }
}
