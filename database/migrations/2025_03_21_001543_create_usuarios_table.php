<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->integer('data_vencimento'); // De 1 a 30
            $table->unsignedBigInteger('regiao_id'); // Chave estrangeira para Região
            $table->unsignedBigInteger('plano_id'); // Chave estrangeira para Plano
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('regiao_id')->references('id')->on('regioes')->onDelete('cascade');
            $table->foreign('plano_id')->references('id')->on('planos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
