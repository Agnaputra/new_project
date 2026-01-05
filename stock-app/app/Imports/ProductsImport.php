<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Lewati header (baris pertama)
        foreach ($rows->skip(1) as $row) {

            // Validasi minimal
            if (!isset($row[0]) || !isset($row[1]) || !isset($row[3])) {
                continue;
            }

            $category = Category::firstOrCreate(
                ['name' => $row[2] ?? 'Umum']
            );

            Product::updateOrCreate(
                ['code' => $row[0]], // barcode = code
                [
                    'name'        => $row[1],
                    'category_id'=> $category->id,
                    'stock'       => (int) $row[3],
                    'unit'        => $row[4] ?? 'pcs',
                    'price'       => (int) ($row[5] ?? 0),
                    'description' => $row[6] ?? null,
                ]
            );
        }
    }
}
