@extends('layouts.gaming')

@section('title', 'Pilih Jenis Booking')

@section('content')
<!-- Animated Background -->
<div class="bg-animated"></div>

<!-- Bubbles -->
@for($i = 0; $i < 6; $i++)
    <div class="bubble" style="
        left: {{ rand(0, 100) }}%;
        width: {{ rand(20, 50) }}px;
        height: {{ rand(20, 50) }}px;
        animation-delay: {{ rand(0, 10) }}s;
        animation-duration: {{ rand(8, 16) }}s;
    "></div>
@endfor

<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen">
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4"
            data-aos="fade-down" data-aos-duration="600">
            Pilih Jenis Booking
        </h1>
        <p class="text-gray-500 mb-8"
           data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
            Pilih salah satu jenis booking untuk melanjutkan
        </p>

        <div class="grid grid-cols-2 gap-4 max-w-xl mx-auto">
            {{-- Card Tamu --}}
            <a href="#" 
               class="bg-white rounded-2xl p-6 border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition transform hover:scale-105 duration-300 text-center"
               data-aos="zoom-in" data-aos-duration="600" data-aos-delay="400">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Booking Tamu</h3>
                <p class="text-gray-500 text-xs mb-3">Booking cepat tanpa perlu login</p>
                <span class="inline-block bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-semibold animate-glow">Pilih</span>
            </a>

            {{-- Card Member --}}
            <div class="bg-white rounded-2xl p-6 border-2 border-gray-200 opacity-75 text-center"
                 data-aos="zoom-in" data-aos-duration="600" data-aos-delay="600">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Member</h3>
                <p class="text-gray-500 text-xs mb-3">Login sebagai member</p>
                <span class="inline-block bg-yellow-100 text-yellow-700 px-4 py-1.5 rounded-full text-xs font-semibold border border-yellow-300">Maintenance</span>
            </div>
        </div>

        <a href="/" class="inline-block mt-6 text-gray-500 hover:text-blue-600 text-sm"
           data-aos="fade-up" data-aos-duration="600" data-aos-delay="800">
            Kembali ke Beranda
        </a>
    </div>
</section>
@endsection