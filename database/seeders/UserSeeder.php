<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
            'username' => 'ningsih',
            'email' => 'ningsih@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '08123456789',
            'gender' => 'Wanita',
            'birth_date' => '1999-01-01',
            'address'=>'Jln Raya Bukittinggi, No 123, Kota Bukittinggi'
        ]);
        User::create([
            'username' => 'pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Pegawai',
            'phone_number' => '08123456789',
            'gender' => 'Wanita',
            'birth_date' => '1999-01-01',
            'address'=>'Jln Raya Mayarakat, No 123, Kota Bukittinggi'
        ]);
        User::create([
            'username' => 'member1',
            'email' => 'member1@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '08123456789',
            'gender' => 'Wanita',
            'birth_date' => '1999-01-01',
            'address'=>'Jln Raya Padang, No 123, Kota Bukittinggi'
        ]);



    }
}
