<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Stok
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-4 overflow-x-auto">

                <table class="w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Tanggal</th>
                            <th class="border p-2">Barang</th>
                            <th class="border p-2 text-center">Tipe</th>
                            <th class="border p-2 text-center">Qty</th>
                            <th class="border p-2 text-center">Stok Sebelum</th>
                            <th class="border p-2 text-center">Stok Sesudah</th>
                            <th class="border p-2">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $history)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2">
                                    {{ $history->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="border p-2">
                                    {{ $history->product->name ?? '-' }}
                                </td>
                                <td class="border p-2 text-center">
                                    @if($history->type === 'IN')
                                        <span class="text-green-600 font-semibold">IN</span>
                                    @elseif($history->type === 'OUT')
                                        <span class="text-red-600 font-semibold">OUT</span>
                                    @else
                                        <span class="text-blue-600 font-semibold">
                                            {{ $history->type }}
                                        </span>
                                    @endif
                                </td>
                                <td class="border p-2 text-center">
                                    {{ $history->quantity }}
                                </td>
                                <td class="border p-2 text-center">
                                    {{ $history->stock_before }}
                                </td>
                                <td class="border p-2 text-center">
                                    {{ $history->stock_after }}
                                </td>
                                <td class="border p-2">
                                    {{ $history->user->name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-4 text-gray-500">
                                    Belum ada riwayat stok
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $histories->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
