<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('faturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->decimal('valor', 10, 2);
            $table->date('vencimento'); // Adicionando a coluna correta
            $table->string('status')->default('pendente'); // pendente, pago, cancelado
            $table->timestamps();

            // Chave estrangeira
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('faturas');
    }
};
