<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'float',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(order::class, 'order_products')
            ->withPivot('quantity');
    }

    public function reviews()
    {
        return $this->hasMany(review::class);
    }
}
