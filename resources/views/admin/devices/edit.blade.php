@extends('layouts.gaming')

@section('title', 'Edit Konsol - Admin')

<section class="relative pt-24 md:pt-28 pb-16 px-4 bg-transparent min-h-screen">
    <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-6" data-aos="fade-down" data-aos-duration="600">Edit Konsol: {{ $device->name }}</h1>
        
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm" data-aos="fade-up" data-aos-duration="600">
            <form action="{{ route('admin.devices.update', $device) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Konsol</label>
                        <input type="text" name="name" value="{{ old('name', $device->name) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Harga per Jam (Rp)</label>
                        <input type="number" name="price_per_hour" value="{{ old('price_per_hour', $device->price_per_hour) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Stok (Unit)</label>
                        <input type="number" name="stock" value="{{ old('stock', $device->stock) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">
                            <option value="available" {{ $device->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="maintenance" {{ $device->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Deskripsi</label>
                        <textarea name="description" rows="2" class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm">{{ old('description', $device->description) }}</textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl text-sm transition">Update</button>
                </div>
            </form>
        </div>
        
        <a href="{{ route('admin.devices.index') }}" class="inline-block mt-4 text-gray-500 hover:text-blue-600 text-sm">← Kembali</a>
    </div>
</section>