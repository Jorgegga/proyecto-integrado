<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nombre');
            $table->string('descripcion')->default('No se ha proporcionado ninguna descripcion');
            $table->string('autor')->default('desconocido');
            $table->foreignId('album_id');
            $table->foreign('album_id')
            ->references('id')->on('albums')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('portada')->default('storage/img/musica/default.png');
            $table->string('ruta')->default('storage/music/default.mp3');
            $table->integer('numCancion')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music');
    }
}
