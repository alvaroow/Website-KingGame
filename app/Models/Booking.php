<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id', 'booking_code', 'name', 'email', 'phone',
        'date', 'start_time', 'end_time', 'duration',
        'total_price', 'notes', 'status'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}