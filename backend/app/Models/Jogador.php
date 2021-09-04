<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jogador extends Model
{
    use SoftDeletes;

    protected $table = 'jogadores';

    protected $fillable = [
        'nome',
        'temporada',
        'data_admissao',
        'posicao',
        'data_nascimento',
    ];

    protected $casts = [
        'data_admissao' => 'datetime',
        'data_nascimento' => 'datetime',
    ];

    public function plantel()
    {
        return $this->belongsTo(Plantel::class, 'plantel_id');
    }
}
