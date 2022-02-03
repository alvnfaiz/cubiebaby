<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  
        'total_price',
        'status_payment',
        'shipping_status',
        'resi_number',
        'order_status',
        'image',
        'shipping_id',
        'destination_id',
        'expired_at',
        'created_at',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    
}
