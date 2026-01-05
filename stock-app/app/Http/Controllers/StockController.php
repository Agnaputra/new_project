<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stockIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::findOrFail($request->product_id);

            $stockBefore = $product->stock;
            $stockAfter  = $stockBefore + $request->quantity;

            $product->update([
                'stock' => $stockAfter
            ]);

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

    public function stockOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::findOrFail($request->product_id);

            if ($product->stock < $request->quantity) {
                abort(400, 'Stok tidak mencukupi');
            }

            $stockBefore = $product->stock;
            $stockAfter  = $stockBefore - $request->quantity;

            $product->update([
                'stock' => $stockAfter
            ]);

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
