<?php

namespace App\Http\Controllers;

use App\Models\Device;

class BookingController extends Controller
{
    public function choose()
    {
        $devices = Device::where('status', 'available')->get();
        return view('booking.choose', compact('devices'));
    }
}