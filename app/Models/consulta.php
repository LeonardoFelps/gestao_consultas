<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consulta extends Model
{
    /**
     * Usando o trait HasFactory para permitir a criação de fábricas de modelos
     * para geração de dados de teste ou populamento de dados na base.
     *
     * @use HasFactory<\Database\Factories\ConsultaFactory>
     */
    use HasFactory;

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * O campo `fillable` é utilizado para proteger o modelo contra
     * a atribuição em massa indesejada, permitindo apenas os campos especificados
     * serem atribuídos.
     *
     * @var array
     */
    protected $fillable = [
        'medico',         // ID do médico responsável pela consulta
        'paciente',       // ID do paciente que realizou a consulta
        'dataehora',      // Data e hora da consulta
        'descricao',      // Descrição ou detalhes sobre a consulta
    ];

    /**
     * Relacionamento de um para muitos inverso: Consulta pertence a um Médico.
     *
     * O método `medico` define a relação entre a consulta e o médico responsável.
     * Utiliza a chave estrangeira `medico` e a chave primária `id` da tabela `medicos`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico', 'id'); 
        // Ajuste 'medico' e 'id' conforme a estrutura da base de dados
    }

}
