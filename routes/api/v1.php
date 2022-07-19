<?php

use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\OrderController;

Route::prefix('v1')->group(function () {

    // Запросы к заказам.
    //
    Route::prefix('orders')
        ->controller(OrderController::class)
        ->group(function () {

            // Список заказов
            Route::get('/', 'index');

            // Создание заказа
            Route::post('create', 'create');

            // Детали заказа
            Route::get('{id}', 'show')
                ->where('id', '\d+');

            // Удаление заказа
            Route::delete('{id}', 'destroy')
                ->where('id', '\d+');
    });

    // Категории каталога товаров
    //
    Route::prefix('categories')
        ->controller(CategoryController::class)
        ->group(function () {

            // Список категорий в заданной области подчинения
            Route::get('{id?}', 'index')
                ->where('id', '\d+');

            // Формирование дерева категорий
            Route::get('tree/{id?}', 'tree')
                ->where('id', '\d+');

        });

});
