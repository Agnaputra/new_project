<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Exports\ProductsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * ===============================
     * DASHBOARD STOK BARANG
     * ===============================
     */
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products'));
    }

    /**
     * ===============================
     * EXPORT EXCEL LAPORAN STOK
     * ===============================
     */
    public function export()
    {
        return Excel::download(
            new ProductsExport,
            'laporan_stok_' . now()->format('Ymd_His') . '.xlsx'
        );
    }
}
