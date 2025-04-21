<?php
// database/migrations/2023_01_01_000004_create_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->float('maximo_horas'); // Limite máximo de horas
            $table->foreignId('curso_id')->constrained('cursos');
            $table->timestamps();
            $table->softDeletes();
            
            // Evita categorias duplicadas no mesmo curso
            $table->unique(['nome', 'curso_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}