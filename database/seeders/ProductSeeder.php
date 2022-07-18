<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Database\Seeders\ProductSeeder
 *
 * @Class ProductSeeder Наполнение каталога товаров.
 * @package Database\Seeders
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $isFirstRow = true;
        if (($handle = fopen(database_path('/data/products.csv'), 'r')) !== false) {

            while (($row = fgetcsv($handle, 2000)) !== false) {
                if ($isFirstRow) {
                    $isFirstRow = false;
                } elseif (!empty($row[4])) {
                    $product = Product::firstOrCreate(
                        [
                            'vendor_id'     => md5($row[0]),
                        ],
                        [
                            'name'          => $row[2],
                            'sku'           => $row[3],
                            'vendor_url'    => $row[0],
                            'price'         => (float)$row[4],
                        ]
                    );

                    $product->name          = $row[2];
                    $product->sku           = $row[3];
                    $product->vendor_url    = $row[0];
                    $product->price         = (float)$row[4];
                    $product->save();

                    // Назначение категории товара
                    if (!empty($row[1])
                        && !is_null($category = Category::whereVendorId(md5($row[1]))->first())
                        && is_null($product->categories->where('id', $category->id)->first()))
                    {
                        $product->categories()->attach($category->id);
                    }
                    die('ok');
                }
            }

            fclose($handle);
        }
    }
}
