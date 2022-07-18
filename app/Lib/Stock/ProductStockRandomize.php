<?php

namespace App\Lib\Stock;

use App\Models\Product;

/**
 * App\Lib\Stock\ProductStockRandomize
 *
 * @Class ProductStockRandomize Наполнение каталога товаров случайными остатками.
 * @package App\Lib\Stock
 */
class ProductStockRandomize
{
    public function __invoke(): void
    {
        Product::chunk(100, function ($products) {
            /** @var Product $product */
            foreach ($products as $product) {
                $product->stock = rand(0, 200);
                $product->save();
            }
        });
    }
}
