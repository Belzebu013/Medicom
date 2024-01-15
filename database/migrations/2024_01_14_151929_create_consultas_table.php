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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medico_id')->constrained();
            $table->foreignId('paciente_id')->constrained();
            $table->date('data_agendamento');
            $table->time('hora_agendamento');
            $table->dateTime('data_hora_consulta');
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
        Schema::dropIfExists('consultas');
    }
};
