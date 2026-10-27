<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\address;
use App\Models\order;
use App\Models\orderProducts;
use App\Models\review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = Category::factory(5)->create();
        $products = Product::factory(2000)->recycle($categories)->create();
        $users = User::factory(20)->create();

        $users->each(function (User $user): void {
            address::factory(fake()->numberBetween(1, 2))
                ->for($user)
                ->create();
        });

        $orders = $users->flatMap(function (User $user) {
            return order::factory(fake()->numberBetween(0, 5))
                ->for($user)
                ->create();
        });

        $orders->each(function (order $order) use ($products): void {
            $products->random(fake()->numberBetween(1, 4))->each(function (Product $product) use ($order): void {
                orderProducts::factory()
                    ->for($order, 'order')
                    ->for($product, 'product')
                    ->create();
            });
        });

        $products->each(function (Product $product) use ($users): void {
            $users->random(fake()->numberBetween(0, 8))->each(function (User $user) use ($product): void {
                review::factory()
                    ->for($user)
                    ->for($product)
                    ->create();
            });
        });
    }
}
