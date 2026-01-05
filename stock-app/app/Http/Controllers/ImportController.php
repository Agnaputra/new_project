<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function show()
    {
        return view('import.products');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()
            ->route('products.index')
            ->with('success', 'Import produk berhasil');
    }
}
