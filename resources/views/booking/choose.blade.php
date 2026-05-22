@extends('layouts.gaming')

@section('title', 'Pilih Konsol & Jenis Booking')

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

<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8"
             data-aos="fade-down" data-aos-duration="600">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Pilih Konsol</h1>
            <p class="text-gray-500 text-sm">Pilih konsol PlayStation favoritmu</p>
        </div>

        @php
            $deviceImages = [
                'PlayStation 5' => asset('images/ps4.png'),
                'PlayStation 4' => asset('images/ps4.png'),
                'PlayStation 3' => asset('images/ps4.png'),
            ];
        @endphp

        {{-- MOBILE: 2 card + 1 card di tengah bawah --}}
        <div class="md:hidden mb-8">
            <div class="grid grid-cols-2 gap-3">
                @foreach($devices->take(2) as $index => $device)
                <div class="bg-white rounded-2xl p-4 border-2 border-gray-200 hover:border-blue-400 transition cursor-pointer konsol-card text-center"
                     data-device="{{ $device->id }}"
                     data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $index * 150 }}">
                    <div class="h-24 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl mb-2 flex items-center justify-center overflow-hidden">
                        <img src="{{ $deviceImages[$device->name] ?? 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $device->name }}" class="w-full h-full object-cover" />
                    </div>
                    <h3 class="text-sm font-bold text-gray-900">{{ $device->name }}</h3>
                    <p class="text-blue-600 font-semibold text-xs mt-1">Rp {{ number_format($device->price_per_hour,0,',','.') }}/jam</p>
                </div>
                @endforeach
            </div>
            @if($devices->count() > 2)
            @php $thirdDevice = $devices->skip(2)->first(); @endphp
            <div class="flex justify-center mt-3">
                <div class="w-1/2 bg-white rounded-2xl p-4 border-2 border-gray-200 hover:border-blue-400 transition cursor-pointer konsol-card text-center"
                     data-device="{{ $thirdDevice->id }}"
                     data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                    <div class="h-24 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl mb-2 flex items-center justify-center overflow-hidden">
                        <img src="{{ $deviceImages[$thirdDevice->name] ?? 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $thirdDevice->name }}" class="w-full h-full object-cover" />
                    </div>
                    <h3 class="text-sm font-bold text-gray-900">{{ $thirdDevice->name }}</h3>
                    <p class="text-blue-600 font-semibold text-xs mt-1">Rp {{ number_format($thirdDevice->price_per_hour,0,',','.') }}/jam</p>
                </div>
            </div>
            @endif
        </div>

        {{-- DESKTOP: 3 kolom --}}
        <div class="hidden md:grid md:grid-cols-3 gap-4 mb-8">
            @foreach($devices as $index => $device)
            <div class="bg-white rounded-2xl p-6 border-2 border-gray-200 hover:border-blue-400 transition cursor-pointer konsol-card text-center"
                 data-device="{{ $device->id }}"
                 data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $index * 150 }}">
                <div class="h-40 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                    <img src="{{ $deviceImages[$device->name] ?? 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $device->name }}" class="w-full h-full object-cover transition duration-500 hover:scale-105" />
                </div>
                <div class="mb-3">
                    <p class="text-sm uppercase tracking-[0.3em] text-blue-600">Konsol</p>
                    <h3 class="mt-2 text-2xl font-bold text-gray-900">{{ $device->name }}</h3>
                </div>
                <p class="text-gray-500 text-xs mt-1">{{ $device->description }}</p>
                <p class="text-blue-600 font-semibold text-xl mt-3">Rp {{ number_format($device->price_per_hour,0,',','.') }}/jam</p>
                <span class="mt-3 inline-block bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-xs font-medium">Pilih</span>
            </div>
            @endforeach
        </div>

        {{-- Pilih Jenis Booking (muncul setelah pilih konsol) --}}
        <div id="bookingTypeSection" class="hidden" data-aos="fade-up" data-aos-duration="600">
            <h2 class="text-lg font-semibold text-gray-700 text-center mb-4">Pilih Jenis Booking</h2>
            <div class="grid grid-cols-2 gap-4 max-w-xl mx-auto">
                {{-- Card Tamu --}}
                <div class="tamu-card bg-white rounded-2xl p-6 border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all cursor-pointer text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Booking Tamu</h3>
                    <p class="text-gray-500 text-xs mb-3">Booking cepat tanpa perlu login</p>
                    <span class="inline-block bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-semibold animate-glow">Pilih</span>
                </div>

                {{-- Card Member --}}
                <div class="bg-white rounded-2xl p-6 border-2 border-gray-200 opacity-75 text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Member</h3>
                    <p class="text-gray-500 text-xs mb-3">Login sebagai member</p>
                    <span class="inline-block bg-yellow-100 text-yellow-700 px-4 py-1.5 rounded-full text-xs font-semibold border border-yellow-300">Maintenance</span>
                </div>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="/" class="text-gray-500 hover:text-blue-600 text-sm">Kembali ke Beranda</a>
        </div>
    </div>
</section>

<script>
document.querySelectorAll('.konsol-card').forEach(card => {
    card.addEventListener('click', function() {
        // Hapus semua highlight
        document.querySelectorAll('.konsol-card').forEach(c => {
            c.classList.remove('border-blue-500', 'bg-blue-50', 'shadow-lg', 'scale-105', 'ring-2', 'ring-blue-300');
            c.classList.add('border-gray-200');
        });
        
        // Highlight card yang dipilih
        this.classList.remove('border-gray-200');
        this.classList.add('border-blue-500', 'bg-blue-50', 'shadow-lg', 'scale-105', 'ring-2', 'ring-blue-300');
        
        const deviceId = this.dataset.device;
        document.getElementById('bookingTypeSection').classList.remove('hidden');
        
        // Scroll ke bawah untuk lihat pilihan Tamu/Member
        document.getElementById('bookingTypeSection').scrollIntoView({ behavior: 'smooth' });
        
        document.querySelector('.tamu-card').onclick = function() {
            window.location.href = '/booking/' + deviceId + '/guest';
        };
    });
});
</script>
@endsection