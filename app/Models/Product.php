<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'deskripsi',
    //     'price',
    //     'capital',
    //     'image',
    //     'id_category',
    //     'status',
    //     'stock',
    //     'created_at',
    //     'updated_at',
    // ];

    protected $guarded = ['id'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
