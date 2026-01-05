<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Stok Barang') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-4 overflow-x-auto">

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Kode</th>
                            <th class="border p-2">Nama Barang</th>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Stok</th>
                            <th class="border p-2">Satuan</th>
                            <th class="border p-2">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="border p-2">{{ $product->code }}</td>
                                <td class="border p-2">{{ $product->name }}</td>
                                <td class="border p-2">
                                    {{ $product->category->name ?? '-' }}
                                </td>
                                <td class="border p-2 text-center">
                                    {{ $product->stock }}
                                </td>
                                <td class="border p-2">{{ $product->unit }}</td>
                                <td class="border p-2">
                                    {{ $product->price ? number_format($product->price) : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4 text-gray-500">
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
