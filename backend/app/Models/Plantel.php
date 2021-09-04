<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plantel extends Model
{
    use SoftDeletes;

    protected $table = 'planteis';

    protected $fillable = [
        'temporada',
    ];
    
    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }
}
