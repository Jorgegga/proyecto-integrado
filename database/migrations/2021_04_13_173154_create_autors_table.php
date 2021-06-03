<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion')->default("No se ha proporcionado ninguna descripción");
            $table->string('foto')->default('storage/img/autor/default.png');
            $table->foreignId('genero_id')->default(2)->nullable();
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
        Schema::dropIfExists('autors');
    }
}
