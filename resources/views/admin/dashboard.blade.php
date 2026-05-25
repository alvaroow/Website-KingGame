@extends('layouts.gaming')

@section('title', 'Admin Dashboard - KingGame')

@section('content')
<div class="bg-animated"></div>

<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen">
    <div class="max-w-6xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-8" data-aos="fade-down" data-aos-duration="600">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-500 mt-2">Kelola konsol dan lihat semua booking</p>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        {{-- Statistik --}}
        <div class="grid grid-cols-3 gap-3 mb-8">
            <div class="bg-white rounded-2xl p-4 border border-gray-200 text-center" data-aos="zoom-in" data-aos-delay="0">
                <p class="text-2xl font-bold text-blue-600">{{ $totalBookings }}</p>
                <p class="text-xs text-gray-500">Total Booking</p>
            </div>
            <div class="bg-white rounded-2xl p-4 border border-gray-200 text-center" data-aos="zoom-in" data-aos-delay="100">
                <p class="text-2xl font-bold text-blue-600">{{ $totalDevices }}</p>
                <p class="text-xs text-gray-500">Konsol</p>
            </div>
            <div class="bg-white rounded-2xl p-4 border border-gray-200 text-center" data-aos="zoom-in" data-aos-delay="200">
                <p class="text-2xl font-bold text-blue-600">{{ $totalUsers }}</p>
                <p class="text-xs text-gray-500">Pelanggan</p>
            </div>
        </div>

        {{-- Manajemen Konsol --}}
        <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-200 shadow-sm mb-6" data-aos="fade-up" data-aos-duration="600">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-900">Manajemen Konsol</h2>
                <a href="{{ route('admin.devices.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-xs font-semibold transition">
                    + Tambah
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs md:text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-3 py-2">Nama</th>
                            <th class="px-3 py-2">Harga/Jam</th>
                            <th class="px-3 py-2">Stok</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(\App\Models\Device::all() as $device)
                        <tr>
                            <td class="px-3 py-2 font-semibold">{{ $device->name }}</td>
                            <td class="px-3 py-2">Rp {{ number_format($device->price_per_hour,0,',','.') }}</td>
                            <td class="px-3 py-2">{{ $device->stock }} unit</td>
                            <td class="px-3 py-2">
                                <span class="px-2 py-1 text-xs rounded-full {{ $device->status == 'available' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $device->status }}
                                </span>
                            </td>
                            <td class="px-3 py-2 flex gap-2">
                                <a href="{{ route('admin.devices.edit', $device) }}" class="text-blue-600 hover:text-blue-800 text-xs">Edit</a>
                                <form action="{{ route('admin.devices.destroy', $device) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Booking --}}
        <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-200 shadow-sm" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Semua Booking</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs md:text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-3 py-2">Kode</th>
                            <th class="px-3 py-2">Nama</th>
                            <th class="px-3 py-2">Konsol</th>
                            <th class="px-3 py-2">Tanggal</th>
                            <th class="px-3 py-2">Jam</th>
                            <th class="px-3 py-2">Total</th>
                            <th class="px-3 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 font-mono text-xs">{{ $booking->booking_code }}</td>
                            <td class="px-3 py-2">{{ $booking->name }}</td>
                            <td class="px-3 py-2">{{ $booking->device->name }}</td>
                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y') }}</td>
                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                            <td class="px-3 py-2">Rp {{ number_format($booking->total_price,0,',','.') }}</td>
                            <td class="px-3 py-2">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($booking->status == 'active') bg-blue-100 text-blue-700
                                    @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($booking->status == 'completed') bg-green-100 text-green-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</section>
@endsection