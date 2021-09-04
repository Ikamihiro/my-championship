<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cor extends Model
{
    use SoftDeletes;

    protected $table = 'cores';

    protected $fillable = [
        'nome',
    ];

    public function times()
    {
        return $this->belongsToMany(
            Time::class,
            'cores_times',
            'cor_id',
            'time_id',
        );
    }
}
