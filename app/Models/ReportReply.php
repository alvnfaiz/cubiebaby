<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'image',
        'value',
        'reply_at',
        'status',
    ];

    //diable timestamps
    public $timestamps = false;

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

}
