<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'id'   => '1',
            'name' => 'Mainan',
            'slug' => 'mainan',
        ]);
        Category::create([
            'id'   => '2',
            'name' => 'Pakaian Dalam',
            'slug' => 'pakaian-dalam',
        ]);
        Category::create([
            'id'   => '3',
            'name' => 'Pakaian',
            'slug' => 'pakaian',
        ]);
        Category::create([
            'id'   => '4',
            'name' => 'Makanan',
            'slug' => 'makanan',
        ]);
        Category::create([
            'id'   => '5',
            'name' => 'Minuman',
            'slug' => 'minuman',
        ]);
        Category::create([
            'id'   => '6',
            'name' => 'Masker',
            'slug' => 'masker',
        ]);
        Category::create([
            'id'   => '7',
            'name' => 'Perlengkapan',
            'slug' => 'perlangkapan',
        ]);
        Category::create([
            'id'   => '8',
            'name' => 'Sabun',
            'slug' => 'sabun',
        ]);
        Category::create([
            'id'   => '9',
            'name' => 'Bedak',
            'slug' => 'bedak',
        ]);
    }
}
