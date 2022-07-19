<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Lib\Catalog\CategoriesManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Отображает категории товаров в заданной области подчинения иерархии категорий.
     *
     * @param    int|null    $id    ИД родительской категории каталога товаров.
     *
     * @return JsonResponse
     */
    public function index(int $id = null): JsonResponse
    {
        return response()->json(
            [
                'data' => CategoriesManager::index($id)
            ]
        );
    }

    /**
     * Отображает дерево категорий каталога товаров в заданной области подчинения.
     *
     * @param    int|null    $id    ИД родительской категории каталога товаров.
     *
     * @return JsonResponse
     */
    public function tree(int $id = null): JsonResponse
    {
        return response()->json(
            [
                'data' => CategoriesManager::tree($id)
            ]
        );
    }
}
