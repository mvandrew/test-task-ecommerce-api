<?php

namespace App\Exceptions;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

/**
 * App\Exceptions\OrderOutOfStock
 *
 * @Class OrderOutOfStock Недостаточно для заказа товара на складе.
 * @package App\Exceptions
 */
class OrderOutOfStock extends \Exception
{
    /** @var Product Заказываемый товар. */
    private Product $product;

    /** @var int Запрашиваемое количество товара. */
    private int $qty;

    public function __construct(&$product, $qty)
    {
        parent::__construct();

        $this->setProduct($product);
        $this->setQty($qty);
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param    Product    $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * @param    int    $qty
     */
    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    /**
     * Отображение сообщения о недостатке товара на складе.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json(
            [
                'message' => __('catalog.error_order_out_of_stock', [
                    'name'  => $this->getProduct()->name,
                    'id'    => $this->getProduct()->id,
                    'stock' => $this->getProduct()->stock,
                    'qty'   => $this->getQty(),
                ]),
            ],
            400
        );
    }
}
