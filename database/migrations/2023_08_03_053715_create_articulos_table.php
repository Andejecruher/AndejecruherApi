<?php

// database/migrations/xxxx_xx_xx_create_articulos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->text('contenido');
            $table->string('imagen_destacada')->nullable();
            $table->timestamp('fecha_publicacion')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable(); // Agregar esta línea
            $table->unsignedBigInteger('categoria_id')->nullable(); // Agregar esta línea
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null'); // Agregar esta línea
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null'); // Agregar esta línea
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}

