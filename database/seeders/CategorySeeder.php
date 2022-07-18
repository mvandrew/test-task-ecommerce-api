<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Database\Seeders\CategorySeeder
 *
 * @Class CategorySeeder Наполнение категорий каталога товаров.
 * @package Database\Seeders
 */
class CategorySeeder extends Seeder
{
    /**
     * Возвращает данные категорий товаров из csv файла.
     *
     * @param    string|null    $parentCategory     Ссылка на страницу родительской категории товаров.
     *
     * @return \Generator
     */
    protected function getCsvCategories(string $parentCategory = null): \Generator
    {
        $isFirstRow = true;
        if (($handle = fopen(database_path('/data/categories.csv'), 'r')) !== false) {
            while (($row = fgetcsv($handle, 2000)) !== false) {
                if ($isFirstRow) {
                    $isFirstRow = false;
                } elseif ((is_null($parentCategory) && empty($row[2])) || $parentCategory == $row[2]) {
                    yield [
                        'name'      => $row[0],
                        'url'       => $row[1],
                        'parent'    => $row[2]
                    ];
                }
            }

            fclose($handle);
        }
    }

    /**
     * Импорт категорий в заданной области подчинения.
     *
     * @param    Category|null    $parent     Родительская категория каталога товаров.
     *
     * @return void
     */
    protected function importCategories(Category $parent = null): void
    {
        $parentUrl      = is_null($parent) ? null : $parent->vendor_url;
        $csvCategories  = $this->getCsvCategories($parentUrl);
        foreach ($csvCategories as $csvCategory) {
            $category = Category::firstOrCreate(
                [
                    'vendor_id'     => md5($csvCategory['url']),
                ],
                [
                    'name'          => $csvCategory['name'],
                    'vendor_url'    => $csvCategory['url'],
                ]
            );

            $category->name = $csvCategory['name'];
            $category->category()->associate($parent);
            $category->save();

            $this->importCategories($category);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->importCategories();
    }
}
