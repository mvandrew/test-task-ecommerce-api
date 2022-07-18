<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

/**
 * App\Exceptions\OrderNotFound
 *
 * @Class OrderNotFound Запрашиваемый заказ не обнаружен в БД.
 * @package App\Exceptions
 */
class OrderNotFound extends Exception
{
    /** @var int ИД запрашиваемого заказа. */
    private int $orderId;

    /**
     * Конструктор класса.
     *
     * @param    int    $orderId    ИД запрашиваемого заказа.
     */
    public function __construct(int $orderId)
    {
        parent::__construct();

        $this->orderId = $orderId;

        $this->message = __('catalog.error_order_not_found', ['id' => $this->orderId]);
    }

    /**
     * Возврат ответа в результат обращения к API.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json(
            [
                'message' => $this->message,
            ],
            404
        );
    }
}
