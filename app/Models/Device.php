<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'price_per_hour', 'stock', 'description', 'image', 'status'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}