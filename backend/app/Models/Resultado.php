<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resultado extends Model
{
    use SoftDeletes;

    protected $table = 'resultados';

    protected $fillable = [
        'gols_mandante',
        'gols_visitante',
    ];

    public function mandante()
    {
        return $this->belongsTo(Time::class, 'mandante_id');
    }

    public function visitante()
    {
        return $this->belongsTo(Time::class, 'visitante_id');
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'partida_id');
    }
}
