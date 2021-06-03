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
            $table->id();
            $table->string('nombre');
            $table->string('descripcion')->default('No se ha proporcionado ninguna descripción');
            $table->foreignId('album_id')->default(0)->nullable();
            $table->foreign('album_id')
            ->references('id')->on('albums')
            ->onDelete('set default')->onUpdate('cascade');
            $table->foreignId('autor_id')->default(2)->nullable();
            $table->foreign('autor_id')
            ->references('id')->on('autors')
            ->onDelete('set default')->onUpdate('cascade');
            $table->string('portada')->default('storage/img/musica/default.png');
            $table->string('ruta')->default('storage/music/default.ogg');
            $table->integer('numCancion')->default(0);
            $table->foreignId('genero_id')->default(2);
            $table->foreign('genero_id')
            ->references('id')->on('generos')
            ->onDelete('set default')->onUpdate('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
