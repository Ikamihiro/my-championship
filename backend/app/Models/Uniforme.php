<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Uniforme extends Model
{
    use SoftDeletes;

    protected $table = 'uniformes';

    protected $fillable = [
        'temporada',
        'modelo_principal',
        'modelo_secundario',
        'time_id',
    ];

    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }
}
