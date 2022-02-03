<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'image',
        'value',
        'created_at',

    ];

    public function reportReply()
    {
        return $this->hasMany(ReportReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
