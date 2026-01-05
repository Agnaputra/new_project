<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::with('category')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Stok',
            'Satuan',
            'Harga',
        ];
    }

    public function map($product): array
    {
        return [
            $product->code,
            $product->name,
            $product->category->name ?? '-',
            $product->stock,
            $product->unit,
            $product->price,
        ];
    }
}
