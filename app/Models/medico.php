<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medico extends Model
{
    protected $fillable = [
        'nome',
        'especializacao'
    ];
}
