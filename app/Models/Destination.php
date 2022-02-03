<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
    ];

    //disable timestamps
    public $timestamps = false;

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
