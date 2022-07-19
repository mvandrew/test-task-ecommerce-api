<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\OrderNotFound;
use App\Http\Controllers\Controller;
use App\Lib\Orders\OrderManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class OrderController extends Controller
{
    /**
     * Отображает общий список доступных заказов.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            [
                'data' => OrderManager::index()
            ]
        );
    }

    /**
     * Создание нового заказа.
     *
     * @param    Request    $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $json = $request->json()->all();

        return response()->json(
            [
                'data' => OrderManager::create($json)
            ]
        );
    }

    /**
     * Возвращает данные заданного заказа.
     *
     * @param    int    $id
     *
     * @return JsonResponse
     * @throws OrderNotFound
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(
            [
                'data' => OrderManager::show($id)
            ]
        );
    }

}
