<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::factory()->create([

            'email' => 'rashed.rabby001@gmail.com',
            'phone'=> '01572158027',
            'username' => 'rashed3075',
            'password'=>Hash::make('123456'),


        ]);
    }
}
