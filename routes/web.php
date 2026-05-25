<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Booking;
use Carbon\Carbon;

// Landing Page - Redirect ke Dashboard jika sudah login
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return app(DeviceController::class)->landing();
})->name('home');

// ==========================================
// AUTH ROUTES (pakai controller)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==========================================
// ROUTES YANG BUTUH LOGIN
// ==========================================
Route::middleware(['auth'])->group(function () {
    

// Dashboard
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    $bookings = Booking::where('user_id', $user->id)
        ->orWhere('email', $user->email)
        ->latest()
        ->get();
    
    $now = Carbon::now();
    
    foreach ($bookings as $booking) {
        // Ambil date, start_time, end_time dengan aman
        $dateString = $booking->date instanceof \Carbon\Carbon 
            ? $booking->date->format('Y-m-d') 
            : $booking->date;
        
        $startString = $booking->start_time instanceof \Carbon\Carbon 
            ? $booking->start_time->format('H:i:s') 
            : $booking->start_time;
            
        $endString = $booking->end_time instanceof \Carbon\Carbon 
            ? $booking->end_time->format('H:i:s') 
            : $booking->end_time;
        
        $startDateTime = Carbon::parse($dateString . ' ' . $startString);
        $endDateTime = Carbon::parse($dateString . ' ' . $endString);
        
        // Cek apakah sedang berlangsung
        if ($booking->status == 'pending' && $now->between($startDateTime, $endDateTime)) {
            $booking->update(['status' => 'active']);
        }
        
        // Cek apakah sudah selesai
        if (in_array($booking->status, ['pending', 'active']) && $endDateTime->isPast()) {
            $booking->update(['status' => 'completed']);
        }
    }
    
    // Refresh data
    $bookings = Booking::where('user_id', $user->id)
        ->orWhere('email', $user->email)
        ->latest()
        ->get();
    
    return view('dashboard', compact('user', 'bookings'));
})->name('dashboard');
    // Pilih Konsol
    Route::get('/booking', function () {
        $devices = Device::where('status', 'available')->get();
        return view('booking.choose', compact('devices'));
    })->name('booking.choose');

    // Form Booking
    Route::get('/booking/{device}', function ($device) {
        $device = Device::findOrFail($device);
        if ($device->status !== 'available') {
            return redirect('/')->with('error', 'Konsol tidak tersedia.');
        }
        return view('booking.create', compact('device'));
    })->name('booking.create');

    // Simpan Booking (CREATE)
    Route::post('/booking', function (Request $request) {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
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
        
        // Cek slot (dengan stok)
        $bookedCount = Booking::where('device_id', $device->id)
            ->where('date', $request->date)
            ->where('status', '!=', 'cancelled')
            ->where(function($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                ->orWhereBetween('end_time', [$startTime, $endTime])
                ->orWhere(function($q2) use ($startTime, $endTime) {
                    $q2->where('start_time', '<=', $startTime)
                        ->where('end_time', '>=', $endTime);
                });
            })->count();

        if ($bookedCount >= $device->stock) {
            return back()->with('error', 'Slot penuh! Stok: ' . $device->stock . ' unit, sudah dibooking: ' . $bookedCount)->withInput();
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
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

        return redirect('/dashboard')->with('success', 'Booking berhasil!');
    })->name('booking.store');

    // Edit Booking (UPDATE)
    Route::get('/booking/{booking}/edit', function ($booking) {
        $booking = Booking::findOrFail($booking);
        return view('booking.edit', compact('booking'));
    })->name('booking.edit');

    Route::put('/booking/{booking}', function (Request $request, $booking) {
        $booking = Booking::findOrFail($booking);
        
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'duration' => 'required|integer|min:1|max:8',
            'notes' => 'nullable|string',
        ]);
        
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->start_time);
        $endTime = $startTime->copy()->addHours((int)$request->duration);
        
        $booking->update([
            'date' => $request->date,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'duration' => (int)$request->duration,
            'total_price' => $booking->device->price_per_hour * (int)$request->duration,
            'notes' => $request->notes,
        ]);
        
        return redirect('/dashboard')->with('success', 'Booking berhasil diupdate!');
    })->name('booking.update');

    // Cancel Booking (DELETE)
    Route::delete('/booking/{booking}', function ($booking) {
        $booking = Booking::findOrFail($booking);
        $booking->update(['status' => 'cancelled']);
        return redirect('/dashboard')->with('success', 'Booking dibatalkan!');
    })->name('booking.cancel');


    // Profile
    Route::get('/profile', function () {
        return view('profile.edit', ['user' => auth()->user()]);
    })->name('profile.edit');

    Route::patch('/profile', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);
        auth()->user()->update($request->only('name', 'email'));
        return back()->with('success', 'Profil berhasil diupdate!');
    })->name('profile.update');
});

// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard Admin + Manajemen Konsol
    Route::get('/dashboard', function () {

        $totalBookings = Booking::count();
        $totalDevices = Device::count();
        $totalUsers = \App\Models\User::where(
            'is_admin',
            false
        )->count();

        $bookings = Booking::with('device')
            ->latest()
            ->paginate(10);

        return view(
            'admin.dashboard',
            compact(
                'totalBookings',
                'totalDevices',
                'totalUsers',
                'bookings'
            )
        );

    })->name('dashboard');


    // Redirect /admin/devices -> dashboard
    Route::get('/devices', function () {
        return redirect()
            ->route('admin.dashboard');
    })->name('devices.index');


    // Form tambah konsol
    Route::get('/devices/create', function () {
        return view(
            'admin.devices.create'
        );
    })->name('devices.create');


    // Simpan konsol
    Route::post('/devices', function (
        Request $request
    ) {

        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_hour' => 'required|integer|min:0',
            'stock' => 'required|integer|min:1',
            'status' => 'nullable',
            'description' => 'nullable|string'
        ]);

        Device::create([
            'name' => $request->name,
            'price_per_hour' => $request->price_per_hour,
            'stock' => $request->stock,
            'status' => $request->status
                ?? 'available',
            'description' => $request->description
        ]);

        return redirect()
            ->route(
                'admin.dashboard'
            )
            ->with(
                'success',
                'Konsol berhasil ditambahkan!'
            );

    })->name('devices.store');


    // Form edit
    Route::get(
        '/devices/{device}/edit',
        function ($device) {

        $device = Device::findOrFail(
            $device
        );

        return view(
            'admin.devices.edit',
            compact('device')
        );

    })->name('devices.edit');


    // Update
    Route::put(
        '/devices/{device}',
        function (
            Request $request,
            $device
        ) {

        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_hour' => 'required|integer|min:0',
            'stock' => 'required|integer|min:1',
            'status' => 'required',
            'description' => 'nullable|string'
        ]);

        $device = Device::findOrFail(
            $device
        );

        $device->update([
            'name' => $request->name,
            'price_per_hour' => $request->price_per_hour,
            'stock' => $request->stock,
            'status' => $request->status,
            'description' => $request->description
        ]);

        return redirect()
            ->route(
                'admin.dashboard'
            )
            ->with(
                'success',
                'Konsol berhasil diupdate!'
            );

    })->name('devices.update');


    // Hapus
    Route::delete(
        '/devices/{device}',
        function ($device) {

        Device::findOrFail(
            $device
        )->delete();

        return redirect()
            ->route(
                'admin.dashboard'
            )
            ->with(
                'success',
                'Konsol berhasil dihapus!'
            );

    })->name('devices.destroy');

});