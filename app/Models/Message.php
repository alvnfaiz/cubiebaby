<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'message',
        'read',
        'admin',
        'created_at',
    ];

    //disable timestamps
    public $timestamps = false;

    public function sender()
    {
        return $this->belongsTo(User::class);
    }


    public function img($value)
    {
        return asset('storage/' . $value);
    }

}
