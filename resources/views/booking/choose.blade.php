@extends('layouts.gaming')

@section('title', 'Pilih Konsol')

@section('content')
<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8"
             data-aos="fade-down" data-aos-duration="600">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Pilih Konsol</h1>
            <p class="text-gray-500 text-sm">Pilih konsol PlayStation favoritmu untuk booking</p>
        </div>

        @php
            $deviceImages = [
                'PlayStation 5' => asset('images/ps4.png'),
                'PlayStation 4' => asset('images/ps4.png'),
                'PlayStation 3' => asset('images/ps4.png'),
            ];
        @endphp

        {{-- MOBILE --}}
        <div class="md:hidden">
            <div class="grid grid-cols-2 gap-3">
                @foreach($devices as $index => $device)
                <a href="{{ route('booking.create', $device) }}" 
                   class="bg-white rounded-2xl p-4 border-2 border-gray-200 hover:border-blue-400 hover:shadow-lg transition text-center"
                   data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $index * 100 }}">
                    <div class="h-24 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl mb-2 flex items-center justify-center overflow-hidden">
                        <img src="{{ $deviceImages[$device->name] ?? asset('images/ps4.png') }}" alt="{{ $device->name }}" class="w-full h-full object-cover" />
                    </div>
                    <h3 class="text-sm font-bold text-gray-900">{{ $device->name }}</h3>
                    <p class="text-blue-600 font-semibold text-xs mt-1">Rp {{ number_format($device->price_per_hour,0,',','.') }}/jam</p>
                </a>
                @endforeach
            </div>
        </div>

        {{-- DESKTOP --}}
        <div class="hidden md:grid md:grid-cols-3 gap-4">
            @foreach($devices as $index => $device)
            <a href="{{ route('booking.create', $device) }}" 
               class="bg-white rounded-2xl p-6 border-2 border-gray-200 hover:border-blue-400 hover:shadow-lg transition text-center"
               data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $index * 150 }}">
                <div class="h-40 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                    <img src="{{ $deviceImages[$device->name] ?? asset('images/ps4.png') }}" alt="{{ $device->name }}" class="w-full h-full object-cover transition duration-500 hover:scale-105" />
                </div>
                <div class="mb-3">
                    <p class="text-sm uppercase tracking-[0.3em] text-blue-600">Konsol</p>
                    <h3 class="mt-2 text-2xl font-bold text-gray-900">{{ $device->name }}</h3>
                </div>
                <p class="text-gray-500 text-xs mt-1">{{ $device->description }}</p>
                <p class="text-blue-600 font-semibold text-xl mt-3">Rp {{ number_format($device->price_per_hour,0,',','.') }}/jam</p>
                <span class="mt-3 inline-block bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-semibold">Pilih</span>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="/dashboard" class="text-gray-500 hover:text-blue-600 text-sm">Kembali ke Dashboard</a>
        </div>
    </div>
</section>
@endsection