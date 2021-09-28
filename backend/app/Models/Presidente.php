<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presidente extends Model
{
    use SoftDeletes;

    protected $table = 'presidentes';

    protected $fillable = [
        'nome',
        'mandato_inicio',
        'mandato_fim',
        'time_id',
    ];

    protected $casts = [
        'mandato_inicio' => 'datetime',
        'mandato_fim' => 'datetime',
    ];

    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }

    public function getMandatoInicioAttribute(string $value)
    {
        $mandatoInicio = new Carbon(new \DateTime($value));
        return $mandatoInicio->toDateString();
    }

    public function getMandatoFimAttribute(string $value)
    {
        $mandatoFim = new Carbon(new \DateTime($value));
        return $mandatoFim->toDateString();
    }
}
