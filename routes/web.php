<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;
use App\Models\Device; 
use App\Models\Booking;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman Pilih Tamu/Member
Route::get('/booking', [BookingController::class, 'choose'])->name('booking.choose');


// Form Booking
Route::get('/booking/{device}/{type}', function ($device, $type) {
    $device = Device::findOrFail($device);
    
    if ($device->status !== 'available') {
        return redirect('/')->with('error', 'Konsol tidak tersedia.');
    }
    
    if (!in_array($type, ['guest', 'member'])) {
        return redirect()->route('booking.choose');
    }
    
    return view('booking.create', compact('device', 'type'));
})->name('booking.create');


// Simpan Booking
Route::post('/booking', function (Request $request) {
    $request->validate([
        'device_id' => 'required|exists:devices,id',
        'booking_type' => 'required|in:guest,member',
        'name' => 'required|string|max:255',
        'email' => 'required_if:booking_type,guest|email|nullable',
        'phone' => 'required|string|max:20',
        'date' => 'required|date|after_or_equal:today',
        'start_time' => 'required',
        'duration' => 'required|integer|min:1|max:8',
        'notes' => 'nullable|string',
    ]);

    $device = Device::findOrFail($request->device_id);
    
    $startTime = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->start_time);
    $duration = (int) $request->duration;
    $endTime = $startTime->copy()->addHours($duration);
    
    // Cek slot
    $existing = Booking::where('device_id', $device->id)
        ->where('date', $request->date)
        ->where('status', '!=', 'cancelled')
        ->where(function($q) use ($startTime, $endTime) {
            $q->whereBetween('start_time', [$startTime, $endTime])
              ->orWhereBetween('end_time', [$startTime, $endTime])
              ->orWhere(function($q2) use ($startTime, $endTime) {
                  $q2->where('start_time', '<=', $startTime)
                     ->where('end_time', '>=', $endTime);
              });
        })->exists();

    if ($existing) {
        return back()->with('error', 'Slot tidak tersedia!')->withInput();
    }

    $booking = Booking::create([
        'device_id' => $device->id,
        'booking_code' => 'KG-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6)),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'date' => $request->date,
        'start_time' => $startTime->format('H:i:s'),
        'end_time' => $endTime->format('H:i:s'),
        'duration' => $duration,
        'total_price' => $device->price_per_hour * $duration,
        'notes' => $request->notes,
        'status' => 'pending',
    ]);

    return redirect('/booking/success/' . $booking->id);
})->name('booking.store');