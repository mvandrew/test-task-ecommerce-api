<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * App\Exceptions\EmptyOrderProducts
 *
 * @Class EmptyOrderProducts Ошибка пустого списка товаров при отправке запроса на создание заказа.
 * @package App\Exceptions
 */
class EmptyOrderProducts extends Exception
{
    /**
     * Отображает сообщение об отсутствии товаров.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()
            ->json(
                [
                    'message' => __('catalog.error_empty_order_products'),
                ],
                400
            );
    }
}
