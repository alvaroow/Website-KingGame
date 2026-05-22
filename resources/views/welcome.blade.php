@extends('layouts.gaming')

@section('title', 'KingGame - PS Rental Terbaik')

@section('content')
<!-- Hero Section -->
<section class="relative pt-24 md:pt-32 pb-16 md:pb-20 px-4 overflow-hidden bg-transparent">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(59,130,246,0.12),_transparent_30%)]"></div>
    
    <div class="container mx-auto relative z-10">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center">
            <!-- Konten Kiri (Text) -->
            <div class="lg:w-1/2 space-y-6 lg:pr-4"
                 data-aos="fade-right" data-aos-duration="800">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-slate-950">
                    Destinasi Gaming PlayStation yang Nyaman dan Modern
                </h1>
                <p class="text-slate-600 text-base sm:text-lg leading-8 max-w-xl">
                    Booking sekarang, pilih konsol favoritmu, dan nikmati sesi game seru dalam ruangan nyaman dengan tampilan profesional.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow-lg animate-glow transition hover:bg-blue-700">
                        Booking Sekarang
                    </a>
                    <a href="#devices" class="inline-flex items-center justify-center rounded-full border border-sky-200 bg-white px-8 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-50">
                        Lihat Konsol
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-4 text-center text-sm text-slate-700">
                    <div class="rounded-3xl bg-white/80 backdrop-blur-sm px-4 py-4 shadow-sm"
                         data-aos="zoom-in" data-aos-delay="200">
                        <p class="text-2xl font-bold text-slate-950 counter" data-target="50">0+</p>
                        <p class="mt-1">Game</p>
                    </div>
                    <div class="rounded-3xl bg-white/80 backdrop-blur-sm px-4 py-4 shadow-sm"
                         data-aos="zoom-in" data-aos-delay="400">
                        <p class="text-2xl font-bold text-slate-950">3</p>
                        <p class="mt-1">Konsol</p>
                    </div>
                    <div class="rounded-3xl bg-white/80 backdrop-blur-sm px-4 py-4 shadow-sm"
                         data-aos="zoom-in" data-aos-delay="600">
                        <p class="text-2xl font-bold text-slate-950">4.9</p>
                        <p class="mt-1">Rating</p>
                    </div>
                </div>
            </div>

            <!-- Gambar Kanan - HANYA DESKTOP -->
            <div class="hidden lg:block lg:w-1/2 relative min-h-[500px]"
                 data-aos="fade-left" data-aos-duration="800">
                <div class="relative overflow-hidden rounded-2xl bg-white shadow-xl w-[72%] ml-auto lg:ml-0 lg:mr-0 lg:-mt-8 tilt-card">
                    <img src="{{ asset('images/hero.png') }}" 
                         alt="PlayStation lounge" 
                         class="w-full h-48 sm:h-56 object-cover transition duration-500 hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-4 text-white">
                        <p class="text-xs uppercase tracking-[0.25em] text-sky-200">PlayStation Spot</p>
                        <p class="mt-1 text-sm font-bold">Ruang Cozy</p>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-2xl bg-white shadow-xl w-[72%] mt-8 ml-auto lg:ml-auto lg:mr-0 lg:mt-6 lg:translate-x-2 tilt-card">
                    <img src="{{ asset('images/ps4.png') }}" 
                         alt="PlayStation controller" 
                         class="w-full h-48 sm:h-56 object-cover transition duration-500 hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-4 text-white">
                        <p class="text-xs uppercase tracking-[0.25em] text-sky-200">Konsol PREMIUM</p>
                        <p class="mt-1 text-sm font-bold">PS5, PS4, PS3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Konsol Section -->
<section id="devices" class="py-16 md:py-20 px-4 bg-transparent">
    <div class="container mx-auto">
        <div class="max-w-3xl mx-auto text-center mb-10"
             data-aos="fade-up">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-600">Konsol Pilihan</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-extrabold text-slate-950">Pilih Konsol PlayStation Sesuai Gaya Gamemu</h2>
            <p class="mt-4 text-slate-600">PS3, PS4, PS5 tersedia dengan setup bersih dan profesional untuk sesi santai atau kompetitif.</p>
        </div>

        @php $featuredDevices = \App\Models\Device::where('status', 'available')->get(); @endphp
        @php
            $deviceImages = [
                'PlayStation 5' => asset('images/ps4.png'),
                'PlayStation 4' => asset('images/ps4.png'),
                'PlayStation 3' => asset('images/ps4.png'),
            ];
        @endphp
        
        {{-- MOBILE: 2 card + 1 card di tengah bawah --}}
        <div class="md:hidden">
            <div class="grid grid-cols-2 gap-3">
                @foreach($featuredDevices->take(2) as $index => $device)
                <div class="rounded-[24px] bg-white p-4 shadow-lg shadow-sky-200/30 border border-sky-100 transition"
                     data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                    <div class="mb-3 overflow-hidden rounded-[20px]">
                        <img src="{{ $deviceImages[$device->name] ?? 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $device->name }}" class="h-28 w-full object-cover" />
                    </div>
                    <div class="mb-2">
                        <p class="text-xs uppercase tracking-[0.3em] text-blue-600">Konsol</p>
                        <h3 class="mt-1 text-lg font-bold text-slate-950">{{ $device->name }}</h3>
                    </div>
                    <p class="text-slate-600 text-xs leading-5 line-clamp-2">{{ $device->description }}</p>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-950">Rp {{ number_format($device->price_per_hour,0,',','.') }}/jam</span>
                    </div>
                    <a href="{{ route('login') }}" class="mt-3 block w-full rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white text-center transition hover:bg-blue-700">Booking</a>
                </div>
                @endforeach
            </div>
            @if($featuredDevices->count() > 2)
            @php $thirdDevice = $featuredDevices->skip(2)->first(); @endphp
            <div class="flex justify-center mt-3">
                <div class="w-[48%] rounded-[24px] bg-white p-4 shadow-lg shadow-sky-200/30 border border-sky-100 transition"
                     data-aos="fade-up" data-aos-delay="300">
                    <div class="mb-3 overflow-hidden rounded-[20px]">
                        <img src="{{ $deviceImages[$thirdDevice->name] ?? 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $thirdDevice->name }}" class="h-28 w-full object-cover" />
                    </div>
                    <div class="mb-2">
                        <p class="text-xs uppercase tracking-[0.3em] text-blue-600">Konsol</p>
                        <h3 class="mt-1 text-lg font-bold text-slate-950">{{ $thirdDevice->name }}</h3>
                    </div>
                    <p class="text-slate-600 text-xs leading-5 line-clamp-2">{{ $thirdDevice->description }}</p>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-950">Rp {{ number_format($thirdDevice->price_per_hour,0,',','.') }}/jam</span>
                    </div>
                    <a href="{{ route('login') }}" class="mt-3 block w-full rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white text-center transition hover:bg-blue-700">Booking</a>
                </div>
            </div>
            @endif
        </div>

        {{-- DESKTOP: 3 kolom --}}
        <div class="hidden md:grid md:grid-cols-3 gap-6">
            @foreach($featuredDevices as $index => $device)
            <div class="rounded-[32px] bg-white p-6 shadow-lg shadow-sky-200/30 border border-sky-100 transition hover:-translate-y-1 tilt-card"
                 data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                <div class="mb-6 overflow-hidden rounded-[28px]">
                </div>
                <div class="mb-4 flex items-center justify-between text-slate-950">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-blue-600">Konsol</p>
                        <h3 class="mt-2 text-2xl font-bold">{{ $device->name }}</h3>
                    </div>
                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-950">Ready</span>
                </div>
                <p class="text-slate-600 text-sm leading-6">{{ $device->description }}</p>
                <div class="mt-6 flex items-center justify-between text-slate-950">
                    <span class="text-xl font-bold">Rp {{ number_format($device->price_per_hour,0,',','.') }}/jam</span>
                    <a href="{{ route('login') }}" class="rounded-full bg-blue-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">Booking</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Schedule Section -->
<section id="reservation" class="py-16 md:py-20 px-4 bg-transparent">
    <div class="container mx-auto">
        <div class="max-w-3xl mx-auto text-center mb-10"
             data-aos="fade-up">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-600">Atur Jadwal Mainmu</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-extrabold text-slate-950">Reservasi Mudah dalam 3 Langkah</h2>
            <p class="mt-4 text-slate-600">Pilih konsol, tentukan waktu, lalu langsung datang untuk sesi gaming yang rapi dan terjadwal.</p>
        </div>

        {{-- MOBILE: 2 card + 1 card di tengah bawah --}}
        <div class="md:hidden">
            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-[24px] border border-blue-100 bg-white p-5 text-center shadow-sm"
                     data-aos="zoom-in" data-aos-delay="0">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-lg font-bold shadow-sm">1</div>
                    <h3 class="text-base font-semibold text-slate-950">Pilih Konsol</h3>
                    <p class="mt-2 text-slate-600 text-xs">Temukan konsol yang sesuai dengan style gamemu.</p>
                </div>
                <div class="rounded-[24px] border border-blue-100 bg-white p-5 text-center shadow-sm"
                     data-aos="zoom-in" data-aos-delay="200">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-lg font-bold shadow-sm">2</div>
                    <h3 class="text-base font-semibold text-slate-950">Pilih Waktu</h3>
                    <p class="mt-2 text-slate-600 text-xs">Atur slot main agar perjalananmu jadi lancar.</p>
                </div>
            </div>
            <div class="flex justify-center mt-3">
                <div class="w-[48%] rounded-[24px] border border-blue-100 bg-white p-5 text-center shadow-sm"
                     data-aos="zoom-in" data-aos-delay="400">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-lg font-bold shadow-sm">3</div>
                    <h3 class="text-base font-semibold text-slate-950">Main Seru</h3>
                    <p class="mt-2 text-slate-600 text-xs">Masuk, duduk, dan nikmati pengalaman gaming yang rapi.</p>
                </div>
            </div>
        </div>

        {{-- DESKTOP: 3 kolom --}}
        <div class="hidden md:grid md:grid-cols-3 gap-6">
            <div class="rounded-[32px] border border-blue-100 bg-white p-8 text-center shadow-sm tilt-card"
                 data-aos="zoom-in" data-aos-delay="0">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-xl font-bold shadow-sm">1</div>
                <h3 class="text-xl font-semibold text-slate-950">Pilih Konsol</h3>
                <p class="mt-3 text-slate-600">Temukan PS3, PS4, atau PS5 yang sesuai dengan style gamemu.</p>
            </div>
            <div class="rounded-[32px] border border-blue-100 bg-white p-8 text-center shadow-sm tilt-card"
                 data-aos="zoom-in" data-aos-delay="200">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-xl font-bold shadow-sm">2</div>
                <h3 class="text-xl font-semibold text-slate-950">Pilih Waktu</h3>
                <p class="mt-3 text-slate-600">Atur slot main agar perjalananmu jadi lancar.</p>
            </div>
            <div class="rounded-[32px] border border-blue-100 bg-white p-8 text-center shadow-sm tilt-card"
                 data-aos="zoom-in" data-aos-delay="400">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-xl font-bold shadow-sm">3</div>
                <h3 class="text-xl font-semibold text-slate-950">Main Seru</h3>
                <p class="mt-3 text-slate-600">Masuk, duduk, dan nikmati pengalaman gaming yang rapi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Games Section -->
<section id="games" class="py-12 md:py-20 px-3 md:px-4 bg-transparent">
    <div class="container mx-auto">
        <div class="max-w-3xl mx-auto text-center mb-6 md:mb-10"
             data-aos="fade-up">
            <p class="text-xs md:text-sm font-semibold uppercase tracking-[0.3em] text-blue-600">Katalog Game</p>
            <h2 class="mt-2 md:mt-4 text-2xl md:text-4xl font-extrabold text-slate-950">Ragam Game PlayStation</h2>
            <p class="mt-2 md:mt-4 text-slate-600 text-xs md:text-base">Dari olahraga sampai aksi petualangan — koleksi kami disusun rapi untuk memudahkan pilihanmu.</p>
        </div>
        @php
            $games = [
                'NBA 2K24' => asset('images/nba2k26.png'),
                'Forza Horizon 6' => asset('images/forza-horizon6.png'),
                'PES 2026' => asset('images/pes2026.png'),
                'God of War 3' => asset('images/god-of-war3.png'),
                'Spider-Man 2' => asset('images/spiderman2.png'),
                'Tekken 8' => asset('images/tekken8.png'),
            ];
        @endphp
        
        {{-- MOBILE: 2 kolom compact --}}
        <div class="md:hidden grid grid-cols-2 gap-2">
            @foreach($games as $title => $image)
            <div class="overflow-hidden rounded-2xl bg-white shadow-md shadow-blue-200/20 transition"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="relative h-28 overflow-hidden">
                    <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                    <div class="absolute bottom-2 left-3 text-white">
                        <p class="text-sm font-bold">{{ explode(' ', $title)[0] }}</p>
                        <p class="text-[10px] text-sky-200">{{ substr($title, 2) }}</p>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-slate-600 text-[11px] leading-4">Game PlayStation populer untuk sesi seru.</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- DESKTOP: 3 kolom --}}
        <div class="hidden md:grid md:gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($games as $title => $image)
            <div class="overflow-hidden rounded-[32px] bg-white shadow-lg shadow-blue-200/30 transition hover:-translate-y-1 tilt-card"
                 data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative h-44 overflow-hidden">
                    <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover transition duration-500 hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <p class="text-lg font-bold">{{ explode(' ', $title)[0] }}</p>
                        <p class="text-xs text-sky-200">{{ substr($title, 2) }}</p>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-slate-600 text-sm">Game PlayStation populer yang cocok untuk sesi ramai atau santai.</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-16 md:py-20 px-4 bg-transparent">
    <div class="container mx-auto">
        <div class="max-w-3xl mx-auto text-center mb-10"
             data-aos="fade-up">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-600">Testimoni</p>
            <h2 class="mt-4 text-3xl md:text-4xl font-extrabold text-slate-950">Apa Kata Mereka tentang KingGame</h2>
            <p class="mt-4 text-slate-600">Dengar langsung pengalaman mereka yang sudah main di sini.</p>
        </div>
        @php
        $testimonials = [
            ['initial' => 'R', 'name' => 'Rizky', 'text' => 'Tempatnya nyaman, PS5 lancar, TV 4K mantap!'],
            ['initial' => 'S', 'name' => 'Sarah', 'text' => 'PS4-nya terawat, koleksi game lengkap!'],
            ['initial' => 'D', 'name' => 'Dimas', 'text' => 'Staff ramah, booking gampang banget.'],
            ['initial' => 'A', 'name' => 'Alya', 'text' => 'Tempat favorit nongkrong sama temen!'],
        ];
        @endphp
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 md:gap-5">
            @foreach($testimonials as $index => $t)
            <div class="rounded-[24px] md:rounded-[32px] border border-blue-100 bg-white p-4 md:p-6 shadow-sm transition hover:-translate-y-1 tilt-card"
                 data-aos="flip-left" data-aos-delay="{{ $index * 200 }}">
                <div class="mb-3 md:mb-4 flex h-10 w-10 md:h-14 md:w-14 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-base md:text-lg font-bold shadow-sm mx-auto">{{ $t['initial'] }}</div>
                <h4 class="font-semibold text-slate-950 text-sm md:text-lg text-center">{{ $t['name'] }}</h4>
                <div class="mt-1 md:mt-2 flex items-center justify-center gap-1 text-yellow-400 text-xs md:text-sm animate-bounce-in">★★★★★</div>
                <p class="mt-2 md:mt-4 text-slate-600 text-xs md:text-sm italic text-center">"{{ $t['text'] }}"</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-20 px-4 bg-transparent"
         data-aos="fade-up" data-aos-duration="1000">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-black">Siap Reservasi Sekarang?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-black/90">Booking slotmu sekarang dan nikmati sesi PlayStationmu dengan nyaman dan menyenangkan.</p>
        <a href="{{ route('login') }}" class="mt-8 inline-flex rounded-full bg-white px-10 py-3 text-sm font-semibold text-blue-600 shadow-xl transition hover:bg-slate-100 animate-glow">
            Booking Sekarang
        </a>
    </div>
</section>
@endsection