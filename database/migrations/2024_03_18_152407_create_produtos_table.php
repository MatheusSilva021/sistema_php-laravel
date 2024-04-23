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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('cod_produto');
            $table->string('descricao');
            $table->integer('estoque');
            $table->string('cod_barras');
            $table->double('valor');
            $table->unsignedBigInteger('cod_grupo');
            $table->foreign('cod_grupo')->references('cod_grupo')->on('grupos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
