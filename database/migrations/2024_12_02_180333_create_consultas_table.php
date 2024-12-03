<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();            // Cria uma coluna de ID autoincrementável.
            $table->string('medico'); // Cria a coluna 'medico', que armazena o nome do médico.
            $table->string('paciente'); // Cria a coluna 'paciente', que armazena o nome do paciente.
            $table->dateTime('dataehora'); // Cria a coluna 'dataehora', que armazena a data e hora da consulta.
            $table->timestamps();     // Cria as colunas 'created_at' e 'updated_at' automaticamente.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas'); // Remove a tabela 'consultas' se ela existir.
    }
};
