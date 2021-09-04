<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arbitro extends Model
{
    use SoftDeletes;

    protected $table = 'arbitros';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'tipo'
    ];

    protected $casts = [
        'data_nascimento' => 'datetime',
    ];

    public function arbitragens()
    {
        return $this->belongsToMany(
            Arbitragem::class,
            'arbitros_ambitragens',
            'arbitro_id',
            'arbitragem_id',
        );
    }
}
