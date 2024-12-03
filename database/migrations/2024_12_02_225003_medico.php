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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id(); // Cria uma coluna ID, que é a chave primária e autoincrementável.
            $table->string('nome'); // Cria uma coluna 'nome' para armazenar o nome do médico.
            $table->string('especializacao'); // Cria uma coluna 'especializacao' para armazenar a especialização do médico.
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at' para gerenciar as datas de criação e atualização.
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos'); // Remove a tabela 'medicos' se ela existir.
    }
};
