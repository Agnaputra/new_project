<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Stok Barang
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Action Bar --}}
            <div class="mb-4 flex justify-end">
                <a href="{{ route('products.export') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                    Export Excel
                </a>
            </div>

            <div class="bg-white shadow rounded p-4 overflow-x-auto">

                <table class="w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2 text-left">Kode</th>
                            <th class="border p-2 text-left">Nama Barang</th>
                            <th class="border p-2 text-left">Kategori</th>
                            <th class="border p-2 text-center">Stok</th>
                            <th class="border p-2 text-left">Satuan</th>
                            <th class="border p-2 text-right">Harga</th>
                            <th class="border p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2">{{ $product->code }}</td>
                                <td class="border p-2">{{ $product->name }}</td>
                                <td class="border p-2">
                                    {{ $product->category->name ?? '-' }}
                                </td>
                                <td class="border p-2 text-center font-semibold">
                                    {{ $product->stock }}
                                </td>
                                <td class="border p-2">
                                    {{ $product->unit }}
                                </td>
                                <td class="border p-2 text-right">
                                    {{ $product->price ? number_format($product->price) : '-' }}
                                </td>

                                {{-- AKSI STOK --}}
                                <td class="border p-2 text-center space-y-1">
                                    {{-- STOK MASUK --}}
                                    <form action="{{ route('stock.in') }}"
                                          method="POST"
                                          class="flex items-center justify-center space-x-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input
                                            type="number"
                                            name="quantity"
                                            min="1"
                                            class="w-16 border rounded px-1 py-0.5 text-sm"
                                            placeholder="+"
                                            required
                                        >
                                        <button
                                            type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs">
                                            Masuk
                                        </button>
                                    </form>

                                    {{-- STOK KELUAR --}}
                                    <form action="{{ route('stock.out') }}"
                                          method="POST"
                                          class="flex items-center justify-center space-x-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input
                                            type="number"
                                            name="quantity"
                                            min="1"
                                            class="w-16 border rounded px-1 py-0.5 text-sm"
                                            placeholder="-"
                                            required
                                        >
                                        <button
                                            type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">
                                            Keluar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-4 text-gray-500">
                                    Data barang belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
