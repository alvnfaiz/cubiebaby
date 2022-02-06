<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'image',
        'created_at',
        'send_at',
    ];

    //disable timestamps
    public $timestamps = false;

    public function recipient()
    {
        return $this->hasMany(BroadcastRecipient::class);
    }

    public function img($value)
    {
        return asset('storage/' . $value);
    }
}
