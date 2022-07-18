<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * App\Exceptions\ProductNotFound
 *
 * @Class ProductNotFound Товар с запрашиваемым ИД не найден.
 * @package App\Exceptions
 */
class ProductNotFound extends Exception
{
    /** @var int ИД искомого товара. */
    private int $productId;

    /**
     * Конструктор класса.
     *
     * @param    int    $productId
     */
    public function __construct(int $productId)
    {
        parent::__construct();

        $this->setProductId($productId);
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param    int    $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * Отображение сообщения об отсутствии товара.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()
            ->json(
                [
                    'message' => __('catalog.error_product_not_found', ['id' => $this->getProductId()])
                ],
                404
            );
    }
}
