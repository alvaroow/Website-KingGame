@extends('layouts.gaming')

@section('title', 'Masuk - KingGame')

<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full">
        {{-- Logo & Header --}}
        <div class="text-center mb-8"
             data-aos="fade-down" data-aos-duration="600">
            <a href="/" class="text-3xl md:text-4xl font-extrabold text-blue-600">
                KING<span class="text-gray-900">GAME</span>
            </a>
            <p class="text-gray-500 mt-2 text-sm">Masuk ke akun kamu untuk booking PlayStation</p>
        </div>

        {{-- Card Login --}}
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-200 shadow-sm"
             data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">

            {{-- Error Message --}}
            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    {{-- Email --}}
                    <div>
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Email</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.828 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm"
                                   placeholder="nama@email.com">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </span>
                            <input type="password" name="password" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md text-sm animate-glow">
                        Masuk
                    </button>
                </div>
            </form>

            {{-- Register Link --}}
            <p class="text-center text-gray-500 text-sm mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Daftar sekarang</a>
            </p>
        </div>

        {{-- Back to Home --}}
        <div class="text-center mt-6">
            <a href="/" class="text-gray-400 hover:text-blue-600 transition text-sm flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>