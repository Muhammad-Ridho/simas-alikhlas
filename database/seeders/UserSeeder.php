<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@gmail.com',
               'role'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Kabag Sarpras User',
               'email'=>'kabagsarpras@gmail.com',
               'role'=> 2,
               'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'Pengelola Cabang User',
                'email'=>'pengelolacabang@gmail.com',
                'role'=> 3,
                'password'=> bcrypt('123456'),
             ],
            [
               'name'=>'Pimpinan User',
               'email'=>'pimpinan@gmail.com',
               'role'=>0,
               'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    
    }
}
