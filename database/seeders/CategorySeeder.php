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
            'name' => 'Lainnya',
            'slug' => 'lainnya',
        ]);
        Category::create([
            'id'   => '2',
            'name' => 'Makanan Ringan',
            'slug' => 'makanan-ringan',
        ]);
        Category::create([
            'id'   => '3',
            'name' => 'Makanan Berat',
            'slug' => 'makanan-berat',
        ]);
        Category::create([
            'id'   => '4',
            'name' => 'Minuman',
            'slug' => 'minuman',
        ]);
        Category::create([
            'id'   => '5',
            'name' => 'Pakaian',
            'slug' => 'pakaian',
        ]);
    }
}
