<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('user_id');
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('music_id');
            $table->foreign('music_id')
            ->references('id')->on('music')
            ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('playlists');
    }
}
