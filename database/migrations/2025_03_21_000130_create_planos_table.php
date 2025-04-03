<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('valor', 10, 2);
            $table->text('descricao');
            $table->unsignedBigInteger('regiao_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            // Índices para melhorar desempenho
            $table->index('regiao_id');
            $table->index('user_id');

            // Chaves estrangeiras
            $table->foreign('regiao_id')->references('id')->on('regioes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Restrições opcionais
            // $table->unique(['user_id', 'regiao_id']); // Descomente se quiser evitar planos duplicados por usuário e região
        });
    }

    public function down()
    {
        Schema::dropIfExists('planos');
    }
};
