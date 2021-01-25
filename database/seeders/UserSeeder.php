<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name'=> 'Test1',
            'email' => 'test@test.com',
            'password'=>Hash::make('test123'),            
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'type'=>'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Bibliotekar',
            'email' => 'lib@lib.com',
            'password' => Hash::make('lib123'),
            'type' =>   'librar'
        ]);

    }
}
