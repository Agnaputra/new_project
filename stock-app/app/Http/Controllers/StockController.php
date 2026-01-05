<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * STOK MASUK
     */
    public function stockIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'note'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::lockForUpdate()->find($request->product_id);

            $stockBefore = $product->stock;
            $stockAfter  = $stockBefore + $request->quantity;

            // Update stok produk
            $product->update([
                'stock' => $stockAfter,
            ]);

            // Simpan riwayat stok
            StockHistory::create([
                'product_id'   => $product->id,
                'type'         => 'IN',
                'quantity'     => $request->quantity,
                'stock_before' => $stockBefore,
                'stock_after'  => $stockAfter,
                'user_id'      => auth()->id(),
            ]);
        });

        return back()->with('success', 'Stok berhasil ditambahkan');
    }

    /**
     * STOK KELUAR
     */
    public function stockOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'note'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::lockForUpdate()->find($request->product_id);

            if ($product->stock < $request->quantity) {
                throw new \Exception('Stok tidak mencukupi');
            }

            $stockBefore = $product->stock;
            $stockAfter  = $stockBefore - $request->quantity;

            // Update stok produk
            $product->update([
                'stock' => $stockAfter,
            ]);

            // Simpan riwayat stok
            StockHistory::create([
                'product_id'   => $product->id,
                'type'         => 'OUT',
                'quantity'     => $request->quantity,
                'stock_before' => $stockBefore,
                'stock_after'  => $stockAfter,
                'user_id'      => auth()->id(),
            ]);
        });

        return back()->with('success', 'Stok berhasil dikurangi');
    }
}
