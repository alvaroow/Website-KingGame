@extends('layouts.gaming')

@section('title', 'Form Booking - ' . $device->name)

<section class="relative pt-20 md:pt-28 pb-16 px-3 md:px-4 bg-transparent min-h-screen">
    <div class="max-w-xl mx-auto">
        <div class="text-center mb-6 md:mb-8"
             data-aos="fade-down" data-aos-duration="600">
            <h1 class="text-xl md:text-3xl font-bold text-gray-900 mb-1 md:mb-2">{{ $device->name }}</h1>
            <p class="text-gray-500 text-sm md:text-base">Rp {{ number_format($device->price_per_hour,0,',','.') }}/jam</p>
        </div>

        @if(session('error'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-2xl p-4 md:p-8 border border-gray-200 shadow-sm"
             data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="device_id" value="{{ $device->id }}">

                <div class="grid grid-cols-2 gap-2 md:gap-4">
                    <div class="col-span-2">
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                               class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 text-xs md:text-sm" placeholder="Nama lengkap">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                               class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 text-xs md:text-sm" placeholder="email@email.com">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Nomor HP</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 text-xs md:text-sm" placeholder="0812-3456-7890">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Tanggal</label>
                        <input type="date" name="date" id="dateInput" value="{{ old('date', date('Y-m-d')) }}" required min="{{ date('Y-m-d') }}"
                               class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 text-xs md:text-sm">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Jam Mulai</label>
                        <select name="start_time" id="startTimeSelect" required class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs md:text-sm">
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Durasi</label>
                        <select name="duration" required class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 text-xs md:text-sm">
                            @for($i=1; $i<=6; $i++)
                                <option value="{{ $i }}">{{ $i }} Jam - Rp {{ number_format($device->price_per_hour * $i,0,',','.') }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 text-xs md:text-sm font-medium mb-1">Game (Opsional)</label>
                        <textarea name="notes" rows="2" class="w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:border-blue-500 text-xs md:text-sm" placeholder="Contoh: FIFA, GTA V...">{{ old('notes') }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 md:py-4 rounded-xl transition shadow-md text-sm md:text-lg">
                            Konfirmasi Booking
                        </button>
                    </div>

                    <div class="col-span-2">
                        <a href="{{ route('booking.choose') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl transition text-center text-sm block">
                            ← Kembali ke Pilih Konsol
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
function updateTimeOptions() {
    const dateInput = document.getElementById('dateInput');
    const timeSelect = document.getElementById('startTimeSelect');
    const selectedDate = dateInput.value;
    const today = new Date().toISOString().split('T')[0];
    const now = new Date();
    let currentHour = now.getHours();
    const currentMinute = now.getMinutes();
    
    // Jika hari ini, mulai dari jam sekarang + 1 (atau jam berikutnya)
    if (selectedDate === today) {
        if (currentMinute > 0) currentHour++;
        if (currentHour < 10) currentHour = 10;
    } else {
        currentHour = 10; // Besok/selanjutnya: mulai jam 10
    }
    
    // Clear options
    timeSelect.innerHTML = '';
    
    // Tambah options
    for (let h = currentHour; h <= 22; h++) {
        const timeString = String(h).padStart(2, '0') + ':00';
        const option = document.createElement('option');
        option.value = timeString;
        option.textContent = timeString;
        timeSelect.appendChild(option);
    }
}

// Jalankan saat halaman load
document.addEventListener('DOMContentLoaded', updateTimeOptions);

// Jalankan saat tanggal diubah
document.getElementById('dateInput').addEventListener('change', updateTimeOptions);
</script>
