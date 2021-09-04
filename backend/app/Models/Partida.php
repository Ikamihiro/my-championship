<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partida extends Model
{
    use SoftDeletes;

    protected $table = 'partidas';

    protected $fillable = [
        'data_partida',
    ];

    protected $casts = [
        'data_partida' => 'datetime',
    ];

    public function mandante()
    {
        return $this->belongsTo(Time::class, 'mandante_id');
    }

    public function visitante()
    {
        return $this->belongsTo(Time::class, 'visitante_id');
    }

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }

    public function resultado()
    {
        return $this->hasOne(Partida::class, 'partida_id');
    }
}
