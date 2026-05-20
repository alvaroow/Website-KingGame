<?php

namespace App\Http\Controllers;

use App\Models\Device;

class DeviceController extends Controller
{
    public function landing()
    {
        $devices = Device::where('status', 'available')->get();
        return view('welcome', compact('devices'));
    }
}