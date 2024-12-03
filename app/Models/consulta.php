<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consulta extends Model
{
    /** @use HasFactory<\Database\Factories\ConsultaFactory> */
    use HasFactory;

    protected $fillable = [
        'medico',
        'paciente',
        'dataehora',
        'descricao'
        
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico', 'id'); // Ajuste 'medico' e 'id' conforme sua base de dados
    }

}
