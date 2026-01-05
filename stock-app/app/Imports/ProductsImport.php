<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {

            // Validasi minimal
            if (
                empty($row[0]) || // code
                empty($row[1]) || // name
                !isset($row[3])   // stock
            ) {
                continue;
            }

            $category = Category::firstOrCreate([
                'name' => $row[2] ?? 'Umum'
            ]);

            Product::updateOrCreate(
                ['code' => $row[0]],
                [
                    'name'        => $row[1],
                    'category_id' => $category->id,
                    'stock'       => (int) $row[3],
                    'unit'        => $row[4] ?? 'pcs',
                    'price'       => (int) ($row[5] ?? 0),
                    'description' => $row[6] ?? null,
                ]
            );
        }
    }
}
