<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('planos', function (Blueprint $table) {
            // Verifica se a coluna 'user_id' já existe antes de adicionar
            if (!Schema::hasColumn('planos', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            // Verifica se a coluna 'mercado_pago_id' já existe antes de adicionar
            if (!Schema::hasColumn('planos', 'mercado_pago_id')) {
                $table->string('mercado_pago_id')->nullable()->after('descricao');
            }

            // Verifica se a coluna 'status' já existe antes de adicionar
            if (!Schema::hasColumn('planos', 'status')) {
                $table->string('status')->default('pendente')->after('mercado_pago_id');
            }
        });
    }

    public function down()
    {
        Schema::table('planos', function (Blueprint $table) {
            if (Schema::hasColumn('planos', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('planos', 'mercado_pago_id')) {
                $table->dropColumn('mercado_pago_id');
            }

            if (Schema::hasColumn('planos', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
