<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transmissao extends Model
{
    use SoftDeletes;

    protected $table = 'transmissoes';

    protected $fillable = [
        'tipo',
        'narrador',
        'data_transmissao',
    ];

    protected $casts = [
        'data_transmissao' => 'datetime',
    ];

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'partida_id');
    }
}
