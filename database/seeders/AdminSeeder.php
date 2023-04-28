<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'password'=>'123456',


        ]);
    }
}
