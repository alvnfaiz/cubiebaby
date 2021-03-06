<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    //use table carts
    protected $table = 'carts';

    protected $fillable = [
        'product_id',
        'user_id',
        'total_product',
    ];

    //disable timestamps
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
