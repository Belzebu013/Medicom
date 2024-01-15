<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as operações de migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf')->unique()->nullable();
            $table->date('data_nascimento');
            $table->string('nome_responsavel')->nullable();
            $table->string('cpf_responsavel')->nullable();
            $table->string('telefone');
            $table->string('email')->unique();
            $table->string('cep');
            $table->string('endereco');
            $table->integer('numero');
            $table->timestamps();
        });
    }

    /**
     * Reverte as operações de migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
};
