<?php

namespace App\Http\Controllers;

use App\Models\StockHistory;

class StockHistoryController extends Controller
{
    public function index()
    {
        $histories = StockHistory::with(['product', 'user'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('stock_histories.index', compact('histories'));
    }
}
