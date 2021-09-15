<?php

namespace App\Models;

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
}
