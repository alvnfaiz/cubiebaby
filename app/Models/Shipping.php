<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'city',
        'cost',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}