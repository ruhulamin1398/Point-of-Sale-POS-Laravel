<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ruhul',
            'email' => 'ruhul@gmail.com',
            'password' => Hash::make('password'),
            'password' => Hash::make('password'),
        ]);
    }
    }

