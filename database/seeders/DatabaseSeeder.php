<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\StoreSeeder;
use Database\Seeders\SettingsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            SettingsSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
