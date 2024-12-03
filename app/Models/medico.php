<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medico extends Model
{
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
        'nome',           // Nome do médico
        'especializacao', // Especialização do médico (ex: Cardiologista, Pediatra)
    ];

    /**
     * Relacionamento de um para muitos: Médico tem muitas Consultas.
     *
     * O método `consultas` define a relação entre o médico e as consultas que ele possui.
     * Utiliza a chave estrangeira `medico` na tabela `consultas` e a chave primária `id`
     * da tabela `medicos`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'medico', 'id');
        // Ajuste 'medico' e 'id' conforme a estrutura da base de dados
    }
}
