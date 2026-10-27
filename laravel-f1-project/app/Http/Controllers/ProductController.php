<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\ApiResponses;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
       $products = Product::all();
       $result = []; 
       $numbers = [];

       foreach ($products as $product) {
            $result[] = [
                'id' => $product->id,
                'name' => $this->formatProductName($product->name),
                'slug' => $product->slug,
                'category' => $product->category,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'status' => $product->status,
            ];
        }

         for($i = 1; $i <= 5; $i++) {
            $numbers[] = $i;
       }
       return $this->ok('Products retrieved successfully', [
            'numbers' => $numbers,
            'products' => $result,
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $this->error('Product not found', 404);
        }

        return $this->ok('Product retrieved successfully', [
                'id' => $product->id,
                'name' => $this->formatProductName($product->name),
                'slug' => $product->slug,
                'category' => $product->category,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'status' => $product->status,
            ]);
    }

    private function formatProductName($name)
    {
       return ucwords(
        strtolower(trim($name)
        )
      );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
