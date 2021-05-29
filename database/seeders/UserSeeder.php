<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'email'=>'ejemplo@ejemplo.es',
            'password'=>Hash::make('admin'),
            'permisos'=>0,
            'id'=>1,
        ]);
        User::create([
            'name'=>'Admin2',
            'email'=>'ejemplo2@ejemplo.es',
            'password'=>Hash::make('admin'),
            'permisos'=>1,
            'id'=>2,
        ]);
        User::create([
            'name'=>'Admin3',
            'email'=>'ejemplo3@ejemplo.es',
            'password'=>Hash::make('admin'),
            'permisos'=>0,
            'id'=>3,
        ]);
        User::create([
            'name'=>'Admin4',
            'email'=>'ejemplo4@ejemplo.es',
            'password'=>Hash::make('admin'),
            'permisos'=>1,
            'id'=>4,
        ]);
    }
}
