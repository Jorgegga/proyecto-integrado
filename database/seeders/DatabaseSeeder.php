<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AlbumSeeder::class);
        //\App\Models\Album::factory(50)->create();
        $this->call(MusicSeeder::class);
        \App\Models\Music::factory(100)->create();
        $this->call(UserSeeder::class);
    }
}
