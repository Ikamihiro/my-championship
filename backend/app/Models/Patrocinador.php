<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patrocinador extends Model
{
    use SoftDeletes;

    protected $table = 'patrocinadores';

    protected $fillable = [
        'nome',
    ];

    public function campeonatos()
    {
        return $this->belongsToMany(
            Campeonato::class,
            'campeonatos_patrocinadores',
            'patrocinador_id',
            'campeonato_id',
        );
    }
}
