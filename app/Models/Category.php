<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //table name
    protected $table = 'category';

    protected $fillable = [
        'name',
        'slug',
    ];

    //disable timestamps
    public $timestamps = false;

    public function product()
    {
        return $this->hasMany(Product::class, 'id_category');
    }
}
