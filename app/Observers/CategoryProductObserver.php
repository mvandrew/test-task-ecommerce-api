<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\CategoryProduct;

/**
 * App\Observers\CategoryProductObserver
 *
 * @Class CategoryProductObserver Обработка событий связывания категорий каталога и товаров.
 * @package App\Observers
 */
class CategoryProductObserver
{
    /**
     * Включение товара в состав родительских категорий для назначаемой категории товаров.
     *
     * @param    CategoryProduct    $categoryProduct
     *
     * @return void
     */
    public function updateRootCategories(CategoryProduct $categoryProduct): void
    {
        // Массив текущих категорий товара.
        $productCategories = $categoryProduct->product->categories->pluck('id')->toArray();

        // Массив родительских категорий каталога.
        $parentCategoryIds = [];
        $parentCategories = $categoryProduct->category->parentCategories();
        foreach ($parentCategories as $parentCategory) {
            if (!in_array($parentCategory->id, $productCategories)) {
                $parentCategoryIds[] = $parentCategory->id;
            }
        }

        // Добавление недостающих категорий к товару.
        if (count($parentCategoryIds) > 0) {
            $categoryProduct->product->categories()->attach($parentCategoryIds);
        }
    }

    /**
     * Handle the CategoryProduct "created" event.
     *
     * @param    CategoryProduct    $categoryProduct
     *
     * @return void
     */
    public function created(CategoryProduct $categoryProduct): void
    {
        $this->updateRootCategories($categoryProduct);
    }

    /**
     * Handle the CategoryProduct "updated" event.
     *
     * @param    CategoryProduct    $categoryProduct
     *
     * @return void
     */
    public function updated(CategoryProduct $categoryProduct): void
    {
        $this->updateRootCategories($categoryProduct);
    }

    /**
     * Handle the CategoryProduct "deleted" event.
     *
     * @param    CategoryProduct  $categoryProduct
     *
     * @return void
     */
    public function deleted(CategoryProduct $categoryProduct): void
    {
        // todo: Реализовать исключение дочерних категорий товаров при удалении корневой категории.
    }

    /**
     * Handle the CategoryProduct "restored" event.
     *
     * @param    CategoryProduct  $categoryProduct
     *
     * @return void
     */
    public function restored(CategoryProduct $categoryProduct): void
    {
        //
    }

    /**
     * Handle the CategoryProduct "force deleted" event.
     *
     * @param  CategoryProduct  $categoryProduct
     *
     * @return void
     */
    public function forceDeleted(CategoryProduct $categoryProduct): void
    {
        //
    }
}
