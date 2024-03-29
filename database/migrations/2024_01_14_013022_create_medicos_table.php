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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('crm');
            $table->unsignedBigInteger('especialidade_id');
            $table->timestamps();

            $table->foreign('especialidade_id')->references('id')->on('especialidades');
        });

        Schema::table('medicos', function (Blueprint $table) {
            $table->dropForeign(['especialidade_id']);
        });
    }

    /**
     * Reverte as operações de migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicos');
    }
};
