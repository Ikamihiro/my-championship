<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estadio extends Model
{
    use SoftDeletes;

    protected $table = 'estadios';

    protected $fillable = [
        'nome',
        'capacidade_total',
        'data_construcao',
        'time_id',
    ];

    protected $casts = [
        'data_construcao' => 'datetime',
    ];

    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }

    public function getDataConstrucaoAttribute(string $value)
    {
        $dataConstrucao = new Carbon(new \DateTime($value));
        return $dataConstrucao->toDateString();
    }
}
