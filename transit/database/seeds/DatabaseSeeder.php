<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
            'name' => 'Abe',
            'email' => 'abe@gmail.com',
            'role' => 'client',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Carl',
            'email' => 'carl@gmail.com',
            'role' => 'operator',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Dave',
            'email' => 'dave@gmail.com',
            'role' => 'operator',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Eli',
            'email' => 'eli@gmail.com',
            'role' => 'operator',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Fin',
            'email' => 'fin@gmail.com',
            'role' => 'analyst',
            'password' => bcrypt('password'),
        ]);
    }
}
