@extends('layouts.gaming')

@section('title', 'Profil - KingGame')

@section('content')
<div class="bg-animated"></div>

<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen">
    <div class="max-w-xl mx-auto">
        <div class="text-center mb-8"
             data-aos="fade-down" data-aos-duration="600">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Profil Saya</h1>
            <p class="text-gray-500 mt-2 text-sm">Kelola informasi akun kamu</p>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        {{-- Update Profil --}}
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-200 shadow-sm mb-6"
             data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Profil</h2>
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md text-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Akun --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm"
             data-aos="fade-up" data-aos-duration="600" data-aos-delay="400">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Info Akun</h2>
            <div class="space-y-2 text-sm text-gray-600">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Terdaftar sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>

        {{-- Kembali --}}
        <div class="text-center mt-6">
            <a href="/dashboard" class="text-gray-500 hover:text-blue-600 text-sm">← Kembali ke Dashboard</a>
        </div>
    </div>
</section>
@endsection