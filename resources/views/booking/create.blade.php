@extends('layouts.gaming')

@section('title', 'Form Booking - ' . $device->name)

@section('content')
<!-- Animated Background -->
<div class="bg-animated"></div>

@for($i = 0; $i < 6; $i++)
    <div class="bubble" style="
        left: {{ rand(0, 100) }}%;
        width: {{ rand(20, 50) }}px;
        height: {{ rand(20, 50) }}px;
        animation-delay: {{ rand(0, 10) }}s;
        animation-duration: {{ rand(8, 16) }}s;
    "></div>
@endfor

<section class="relative pt-20 md:pt-28 pb-16 px-3 md:px-4 bg-transparent min-h-screen">
    <div class="max-w-xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-6 md:mb-8"
             data-aos="fade-down" data-aos-duration="600">
            <h1 class="text-xl md:text-3xl font-bold text-gray-900 mb-1 md:mb-2">{{ $device->name }}</h1>
            <p class="text-gray-500 text-sm md:text-base">Rp {{ number_format($device->price_per_hour,0,',','.') }}/jam</p>
            <span class="mt-2 inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                {{ $type == 'guest' ? 'Booking Tamu' : 'Member' }}
            </span>
        </div>

        @if($type == 'member')
            {{-- Maintenance Notice --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 md:p-8 text-center"
                 data-aos="fade-up" data-aos-duration="600">
                <h2 class="text-lg md:text-xl font-bold text-yellow-800 mb-2">Fitur Member</h2>
                <p class="text-yellow-700 text-sm mb-4">Fitur booking untuk member sedang dalam maintenance.</p>
                <a href="{{ route('booking.choose') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition shadow-md text-sm">
                    Kembali
                </a>
            </div>
        @else
            {{-- Form Booking Tamu --}}
            <div class="bg-white rounded-2xl p-4 md:p-8 border border-gray-200 shadow-sm"
                 data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="device_id" value="{{ $device->id }}">
                    <input type="hidden" name="booking_type" value="guest">

                    {{-- Mobile: 2 kolom compact | Desktop: tetap --}}
                    <div class="grid grid-cols-2 gap-2 md:gap-4 md:space-y-4">
                        {{-- Nama - Full width --}}
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs md:text-sm" placeholder="Nama lengkap">
                        </div>
                        
                        {{-- Email - Kiri --}}
                        <div>
                            <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs md:text-sm" placeholder="email@email.com">
                        </div>

                        {{-- Nomor HP - Kanan --}}
                        <div>
                            <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Nomor HP</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                   class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs md:text-sm" placeholder="0812-3456-7890">
                        </div>

                        {{-- Tanggal - Kiri --}}
                        <div>
                            <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Tanggal</label>
                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required min="{{ date('Y-m-d') }}"
                                   class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs md:text-sm">
                        </div>

                        {{-- Jam Mulai - Kanan --}}
                        <div>
                            <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Jam Mulai</label>
                            <select name="start_time" required class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs md:text-sm">
                                @for($h=10; $h<=22; $h++)
                                    <option value="{{ sprintf('%02d:00', $h) }}">{{ sprintf('%02d:00', $h) }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Durasi - Full width --}}
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Durasi</label>
                            <select name="duration" required class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs md:text-sm">
                                @for($i=1; $i<=6; $i++)
                                    <option value="{{ $i }}">{{ $i }} Jam - Rp {{ number_format($device->price_per_hour * $i,0,',','.') }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Game Request - Full width --}}
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Game (Opsional)</label>
                            <textarea name="notes" rows="2" class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs md:text-sm" placeholder="Contoh: FIFA, GTA V...">{{ old('notes') }}</textarea>
                        </div>

                        {{-- Tombol - Full width --}}
                        <div class="col-span-2">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 md:py-4 rounded-xl transition shadow-md text-sm md:text-lg">
                                Konfirmasi Booking
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
</section>
@endsection