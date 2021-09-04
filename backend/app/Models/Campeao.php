<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campeao extends Model
{
    use SoftDeletes;

    protected $table = 'campeoes';

    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }
}
