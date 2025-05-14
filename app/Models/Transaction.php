<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{  
    protected $fillable = [
        'booking_id',
        'payment_date',
        'payment_method',
        'payment_total'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class)->withTrashed();
    }
}
