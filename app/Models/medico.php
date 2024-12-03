<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medico extends Model
{
    protected $fillable = [
        'nome',
        'especializacao'
    ];

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'medico', 'id');
    }
}
