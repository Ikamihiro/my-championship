<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Time extends Model
{
    use SoftDeletes;

    protected $table = 'times';

    protected $fillable = [
        'nome',
        'ano_fundacao',
        'cidade_id'
    ];

    protected $casts = [
        'ano_fundacao' => 'datetime',
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function cores()
    {
        return $this->belongsToMany(
            Cor::class,
            'cores_times',
            'time_id',
            'cor_id',
        );
    }

    public function presidente()
    {
        return $this->hasOne(Presidente::class, 'time_id');
    }

    public function estadio()
    {
        return $this->hasOne(Estadio::class, 'time_id');
    }

    public function uniforme()
    {
        return $this->hasOne(Uniforme::class, 'time_id');
    }

    public function campeonatos()
    {
        return $this->belongsToMany(
            Campeonato::class,
            'campeonatos_times',
            'time_id',
            'campeonato_id',
        );
    }

    public function planteis()
    {
        return $this->hasMany(Plantel::class);
    }
}
