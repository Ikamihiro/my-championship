<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComissaoTecnica extends Model
{
    use SoftDeletes;

    protected $table = 'comissoes_tecnicas';

    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }

    public function membros()
    {
        return $this->hasMany(Membro::class, 'comissao_id');
    }
}
