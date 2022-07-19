<?php

namespace App\Lib\Catalog;

use App\Models\Category;

/**
 * App\Lib\Catalog\CategoriesManager
 *
 * @Class CategoriesManager Управление категориями каталога товаров.
 * @package App\Lib\Catalog
 */
class CategoriesManager
{

    /**
     * Возвращает массив категорий товаров в заданной области подчинения иерархии категорий.
     *
     * @param    int|null    $categoryId    ИД родительской категории каталога товаров.
     *
     * @return ?array
     */
    public static function index(int $categoryId = null): ?array
    {
        $categories = Category::whereCategoryId($categoryId)
            ->orderBy('name')
            ->get(['id', 'name', 'category_id'])
            ->toArray();

        return count($categories) > 0 ? $categories : null;
    }

    /**
     * Возвращает массив дерева категорий товаров в заданной области подчинения иерархии категорий.
     *
     * @param    int|null    $categoryId    ИД родительской категории каталога товаров.
     *
     * @return array|null
     */
    public static function tree(int $categoryId = null): ?array
    {
        $tree = [];

        $categories = Category::whereCategoryId($categoryId)
            ->orderBy('name')
            ->get(['id', 'name']);
        foreach ($categories as $category) {
            $tree[] = [
                'id'            => $category->id,
                'name'          => $category->name,
                'categories'    => self::tree($category->id)
            ];
        }

        return count($tree) > 0 ? $tree : null;
    }
}
