<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Import Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-4">

                <form action="{{ route('import.products.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">
                            File Excel (.xlsx)
                        </label>
                        <input type="file"
                               name="file"
                               class="border rounded w-full p-2"
                               required>
                    </div>

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Import
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
