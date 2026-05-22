@extends('layouts.gaming')

@section('title', 'Edit Booking')

@section('content')
<div class="bg-animated"></div>

<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen">
    <div class="max-w-xl mx-auto">
        <div class="text-center mb-6"
             data-aos="fade-down" data-aos-duration="600">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Booking</h1>
            <p class="text-gray-500 text-sm">{{ $booking->device->name }} • {{ $booking->booking_code }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm"
             data-aos="fade-up" data-aos-duration="600">
            <form action="{{ route('booking.update', $booking) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-1">Tanggal</label>
                            <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($booking->date)->format('Y-m-d')) }}" required min="{{ date('Y-m-d') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-1">Jam Mulai</label>
                            <select name="start_time" required class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">
                                @for($h=10; $h<=22; $h++)
                                    <option value="{{ sprintf('%02d:00', $h) }}" {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') == sprintf('%02d:00', $h) ? 'selected' : '' }}>
                                        {{ sprintf('%02d:00', $h) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Durasi</label>
                        <select name="duration" required class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">
                            @for($i=1; $i<=6; $i++)
                                <option value="{{ $i }}" {{ $booking->duration == $i ? 'selected' : '' }}>{{ $i }} Jam</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Game (Opsional)</label>
                        <textarea name="notes" rows="2" class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">{{ old('notes', $booking->notes) }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <a href="/dashboard" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl transition text-center text-sm">
                            Kembali
                        </a>
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition text-sm">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection