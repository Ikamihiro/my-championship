<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arbitragem extends Model
{
    use SoftDeletes;

    protected $table = 'arbitragens';

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'partida_id');
    }

    public function arbitros()
    {
        return $this->belongsToMany(
            Arbitro::class,
            'arbitros_ambitragens',
            'arbitragem_id',
            'arbitro_id',
        );
    }
}
