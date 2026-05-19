<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola data pengguna dan ketersediaan konsol PlayStation.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 p-4 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-8">

                <!-- Riwayat Booking -->
                <section class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 bg-slate-50 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-slate-900">Riwayat Booking</h3>
                        <p class="mt-1 text-sm text-slate-600">Semua booking yang pernah dilakukan oleh pengguna.</p>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Kode Booking</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Konsol</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Durasi</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Total</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @php
                                    $allBookings = \App\Models\Booking::with('device')->orderBy('created_at', 'desc')->take(20)->get();
                                @endphp
                                @forelse($allBookings as $booking)
                                    <tr>
                                        <td class="px-4 py-4 text-gray-900 font-mono text-xs">{{ $booking->booking_code }}</td>
                                        <td class="px-4 py-4 text-gray-900">{{ $booking->name }}</td>
                                        <td class="px-4 py-4 text-gray-900">{{ $booking->device->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-4 text-gray-500">{{ $booking->date->format('d M Y') }}</td>
                                        <td class="px-4 py-4 text-gray-500">{{ $booking->duration }} jam</td>
                                        <td class="px-4 py-4 text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4">
                                            @if($booking->status === 'pending')
                                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            @elseif($booking->status === 'confirmed')
                                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            @elseif($booking->status === 'completed')
                                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-red-100 text-red-700">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada data booking.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Ketersediaan Konsol -->
                <section class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 bg-slate-50 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-slate-900">Ketersediaan Konsol</h3>
                        <p class="mt-1 text-sm text-slate-600">Perbarui status konsol antara tersedia dan maintenance.</p>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Konsol</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Harga / Jam</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse($devices as $device)
                                    <tr>
                                        <td class="px-4 py-4 text-gray-900">{{ $device->name }}</td>
                                        <td class="px-4 py-4 text-gray-900">Rp {{ number_format($device->price_per_hour, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $device->status === 'available' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                                {{ ucfirst($device->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <form method="POST" action="{{ route('dashboard.devices.availability', $device) }}" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $device->status === 'available' ? 'maintenance' : 'available' }}">
                                                <button type="submit" class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $device->status === 'available' ? 'bg-amber-500 text-white hover:bg-amber-600' : 'bg-emerald-500 text-white hover:bg-emerald-600' }}">
                                                    {{ $device->status === 'available' ? 'Atur Maintenance' : 'Set Available' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada data konsol.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
                                   