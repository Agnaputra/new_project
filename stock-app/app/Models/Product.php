<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category_id',
        'unit',
        'price',
        'stock',
        'description',
    ];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke riwayat stok
    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class);
    }
}
