<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Settings::create([
            'name' => 'app_name',
            'value' => 'Laravel E-commerce',
        ]);
        Settings::create([
            'name' => 'app_email',
            'value' => 'admin@mamashop.com',
        ]);
        Settings::create([
            'name' => 'app_phone',
            'value' => '08123456789',
        ]);
        Settings::create([
            'name' => 'app_address',
            'value' => 'Jl. Kebon Jeruk No. 1',
        ]);
        Settings::create([
            'name' => 'app_about',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos, quisquam.',
        ]);
        Settings::create([
            'name' => 'facebook',
            'value' => 'https://facebook.com',
        ]);
        Settings::create([
            'name' => 'twitter',
            'value' => 'https://twitter.com',
        ]);
        Settings::create([
            'name' => 'instagram',
            'value' => 'https://instagram.com',
        ]);
        Settings::create([
            'name' => 'app_logo',
            'value' => 'https://i.ibb.co/nzGDjkh/Logo.png',
        ]);


    }
}
