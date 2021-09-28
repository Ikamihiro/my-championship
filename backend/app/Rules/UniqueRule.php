<?php

namespace App\Rules;

use Lib\Validation\Rule;
use Illuminate\Database\Capsule\Manager as Database;

class UniqueRule extends Rule
{
    public string $table;
    public string $column;
    public ?string $idIgnored;

    public function __construct(string $table, string $column, string $idIgnored = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->idIgnored = $idIgnored;
    }

    public function validate($field): bool
    {
        $query = Database::table($this->table)->select();

        if (!is_null($this->idIgnored)) {
            $query->where('id', '<>', $this->idIgnored);
        }

        $result = $query->where($this->column, $field)->get();

        if (!$result->isEmpty()) {
            $this->setError($this->column . ' precisa ser um valor único!');
        }

        return $result->isEmpty();
    }
}
