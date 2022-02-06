<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phone_number',
        'gender',
        'birth_date',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function latestMessage() 
    {
        return $this->hasOne(Message::class, 'user_id')->latest();
    }

    public function messages(){
        return $this->hasMany(Message::class, 'user_id');
    }

    public function user_activity()
    {
        return $this->belongsTo(UserActivity::class, 'user_id');
    }
}

