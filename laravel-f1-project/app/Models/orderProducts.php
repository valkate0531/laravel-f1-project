<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderProducts extends Model
{
    use HasFactory;

    protected $table = 'order_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    public function order()
    {
        return $this->belongsTo(order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
