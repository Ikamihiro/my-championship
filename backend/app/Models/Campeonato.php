<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campeonato extends Model
{
    use SoftDeletes;

    protected $table = 'campeonatos';

    protected $fillable = [
        'nome',
        'temporada',
        'tipo',
        'premiacao_valor',
    ];

    public function times()
    {
        return $this->belongsToMany(
            Time::class,
            'campeonatos_times',
            'campeonato_id',
            'time_id',
        );
    }

    public function patrocinadores()
    {
        return $this->belongsToMany(
            Patrocinador::class,
            'campeonatos_patrocinadores',
            'campeonato_id',
            'patrocinador_id',
        );
    }

    public function partidas()
    {
        return $this->hasMany(Partida::class, 'campeonato_id');
    }
}
