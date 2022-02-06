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
            'name' => 'Boneka',
            'slug' => 'boneka',
        ]);
        Category::create([
            'id'   => '3',
            'name' => 'Dompet',
            'slug' => 'dompet',
        ]);
        Category::create([
            'id'   => '4',
            'name' => 'Hijab Motif',
            'slug' => 'hijab-motif',
        ]);
        Category::create([
            'id'   => '5',
            'name' => 'Kutek',
            'slug' => 'kutek',
        ]);
        Category::create([
            'id'   => '6',
            'name' => 'Masker',
            'slug' => 'masker',
        ]);
        Category::create([
            'id'   => '7',
            'name' => 'Sarung Tangan Wol',
            'slug' => 'sarung-tangan-wol',
        ]);
        Category::create([
            'id'   => '8',
            'name' => 'SheetMask',
            'slug' => 'sheetmask',
        ]);
        Category::create([
            'id'   => '9',
            'name' => 'Strap Masker',
            'slug' => 'strap-masker',
        ]);
    }
}
