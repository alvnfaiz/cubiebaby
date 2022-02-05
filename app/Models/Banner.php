<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',~
        'status',
        'alt',
    ];

    //disable timestamps
    public $timestamps = false;

    public function img($value)
    {
        return asset('storage/' . $value);
    }

    public function getStatusAttribute($value)
    {
        return $value == 'active' ? 'Active' : 'Inactive';
    }

    public function getAltAttribute($value)
    {
        return $value ?: 'Produk Terbaru/Terdiskon dll';
    }
}
