@extends('layouts.gaming')

@section('title', 'Dashboard - KingGame')

@section('content')
<div class="bg-animated"></div>

<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen">
    <div class="max-w-4xl mx-auto">
        {{-- Welcome --}}
        <div class="text-center mb-8"
             data-aos="fade-down" data-aos-duration="600">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-500 mt-2">Kelola booking PlayStation kamu di sini</p>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

{{-- Quick Actions --}}
<div class="flex justify-center mb-8">
    <a href="{{ route('booking.choose') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white rounded-2xl px-8 py-4 shadow-lg transition text-center"
       data-aos="zoom-in" data-aos-delay="0">
        <span class="text-sm md:text-base font-semibold">Booking Sekarang</span>
    </a>
</div>

        {{-- Riwayat Booking --}}
        <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-200 shadow-sm"
             data-aos="fade-up" data-aos-duration="600">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Riwayat Booking</h2>
            
            @if($bookings->count() > 0)
                <div class="space-y-3">
                    @foreach($bookings as $booking)
                    <div class="border border-gray-200 rounded-xl p-4">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $booking->device->name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }} • 
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} ({{ $booking->duration }} jam)
                                </p>
                                <p class="text-xs text-gray-400 mt-1">Kode: {{ $booking->booking_code }}</p>
                                <p class="text-sm font-medium mt-1">Rp {{ number_format($booking->total_price,0,',','.') }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($booking->status == 'completed') bg-green-100 text-green-700
                                    @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($booking->status == 'cancelled') bg-red-100 text-red-700
                                    @else bg-blue-100 text-blue-700 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                @if($booking->status == 'pending')
                                    <a href="{{ route('booking.edit', $booking) }}" class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                                    <form action="{{ route('booking.cancel', $booking) }}" method="POST" onsubmit="return confirm('Batalkan booking ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Batal</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">Belum ada booking</p>
                    <a href="{{ route('booking.choose') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full text-sm font-semibold transition">
                        Booking Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection