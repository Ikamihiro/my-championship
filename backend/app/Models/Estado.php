<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;

    protected $table = 'estados';

    protected $fillable = [
        'nome',
        'sigla',
    ];

    public function cidades()
    {
        return $this->hasMany(Cidade::class, 'estado_id');
    }
}
