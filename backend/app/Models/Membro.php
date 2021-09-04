<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membro extends Model
{
    use SoftDeletes;

    protected $table = 'membros';

    protected $fillable = [
        'nome',
        'funcao',
        'data_admissao'
    ];

    protected $casts = [
        'data_admissao' => 'datetime',
    ];

    public function comissao()
    {
        return $this->belongsTo(ComissaoTecnica::class, 'comissao_id');
    }
}
