<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion')->default('No se ha proporcionado ninguna descripción');
            $table->string('portada')->default('storage/img/album/default.png');
            $table->foreignId('autor_id')->default(1)->nullable();
            $table->foreign('autor_id')->references('id')->on('autors')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('genero_id')->default(1)->nullable();
            $table->foreign('genero_id')
            ->references('id')->on('generos')
            ->onDelete('set null')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('albums');
    }
}
