<?php
// database/migrations/2023_01_01_000001_create_eixos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEixosTable extends Migration
{
    public function up()
    {
        Schema::create('eixos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100); // Nome do eixo (ex: Tecnologia, Saúde)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eixos');
    }
}
