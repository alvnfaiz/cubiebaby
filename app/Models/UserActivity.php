<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_login',
        'login_count',
        'order_count',
    ];

    //disable timestamps
    public $timestamps = false;
    //primary key user_id
    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class, $user_id);
    }

}
