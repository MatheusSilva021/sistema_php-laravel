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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('cod_pedido');
            $table->unsignedBigInteger('cod_usuario');
            $table->unsignedBigInteger('cod_produto');
            $table->unsignedBigInteger('comanda');
            $table->foreign('comanda')->references('comanda')->on('comandas')->onDelete('cascade');
            $table->foreign('cod_usuario')->references('cod_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('cod_produto')->references('cod_produto')->on('produtos')->onDelete('cascade');
            $table->string('desc_produto');
            $table->integer('quantidade_produto');
            $table->double('valor_unit');
            $table->string('cod_grupo');
            $table->string('mesa');
            $table->string('observacao');
            $table->string('status');
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
