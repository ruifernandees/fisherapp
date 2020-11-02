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
            'name' => 'José',
            'email' => 'jose@mail.com',
            'cpf' => '11111111111',
            'phone' => '11111111111',
            'address' => 'Rua do Laravel',
            'password' => Hash::make('12345678')
        ]);

        DB::table('users')->insert([
            'name' => 'João',
            'email' => 'joao@mail.com',
            'cpf' => '22222222222',
            'phone' => '22222222222',
            'address' => 'Rua do Rails',
            'password' => Hash::make('12345678')
        ]);

        DB::table('users')->insert([
            'name' => 'Paulo',
            'email' => 'paulo@mail.com',
            'cpf' => '33333333333',
            'phone' => '33333333333',
            'address' => 'Rua do .NET',
            'password' => Hash::make('12345678')
        ]);

        DB::table('users')->insert([
            'name' => 'Pedro',
            'email' => 'pedro@mail.com',
            'cpf' => '4444444444',
            'phone' => '4444444444',
            'address' => 'Rua do Spring',
            'password' => Hash::make('12345678')
        ]);
    }
}
