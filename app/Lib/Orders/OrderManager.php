<?php

namespace App\Lib\Orders;

use App\Exceptions\EmptyOrderProducts;
use App\Exceptions\OrderCreationRequest;
use App\Exceptions\OrderNotFound;
use App\Exceptions\OrderOutOfStock;
use App\Exceptions\OrderRowVerification;
use App\Exceptions\ProductNotFound;
use App\Models\Order;
use App\Models\OrderRow;
use App\Models\Product;
use App\Models\User;
use DB;
use Throwable;
use Validator;

/**
 * App\Lib\Orders\OrderManager
 *
 * @Class OrderManager Управление заказами покупателя.
 * @package App\Lib\Orders
 */
class OrderManager
{

    /**
     * Создание заказа покупателя.
     *
     * @param    array    $orderData
     *
     * @return array|null
     * @throws EmptyOrderProducts
     * @throws Throwable
     */
    public static function create(array &$orderData): ?array
    {
        // Проверка входящего запроса на создание заказа.
        //
        $validator = Validator::make($orderData, [
            'products'  => 'required|array',
            'user_id'   => 'integer',
            'phone'     => 'max:50',
            'email'     => 'required|email|max:255',
            'address'   => 'required',
        ]);

        if ($validator->fails()) {
            throw new OrderCreationRequest($validator->errors()->getMessages());
        }


        // Проверка на предмет пустого списка товаров в запросе на создание заказа.
        //
        if (count($orderData['products']) > 0) {
            $orderProducts = $orderData['products'];
        } else {
            throw new EmptyOrderProducts();
        }


        // Определение пользователя, от имени которого оформляется заказ.
        //
        if (isset($orderData['user_id']) && preg_match('/^\d+$/', $orderData['user_id'])) {
            $user = User::whereId((int)$orderData['user_id'])->first();
        } else {
            $user = null;
        }

        // Формирование заказа на основании данных запроса.
        //
        $orderId = null;
        DB::transaction(function () use ($orderProducts, $user, $orderData, &$orderId) {

            // Формирование заказа в журнале.
            //
            $order = new Order();
            $order->user()->associate($user);
            $order->phone               = $orderData['phone'] ?? null;
            $order->email               = $orderData['email'] ?? null;
            $order->address             = $orderData['address'] ?? null;
            $order->customer_comment    = $orderData['customer_comment'] ?? null;
            $order->save();

            // Наполнение заказа строками.
            //
            foreach ($orderProducts as $orderProduct) {

                $rowValidator = Validator::make($orderProduct, [
                    'product_id'    => 'required|integer',
                    'qty'           => 'required|integer|min:1',
                ]);

                if ($rowValidator->fails()) {
                    throw new OrderRowVerification($rowValidator->errors()->getMessages());
                }

                $requestProductId   = (int)$orderProduct['product_id'];     // ИД запрашиваемого товара.
                $requestQty         = (int)$orderProduct['qty'];            // Запрашиваемое количество товара.

                if (is_null($product = Product::whereId($requestProductId)->first())) {
                    throw new ProductNotFound($requestProductId);
                } elseif ($product->stock < $requestQty) {
                    throw new OrderOutOfStock($product, $requestQty);
                } else {
                    // Уменьшение количества в наличии у товара
                    $product->stock -= $requestQty;
                    $product->save();

                    // Создание строки заказа
                    $orderRow = new OrderRow(
                        [
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'qty' => $requestQty,
                            'price' => $product->price,
                        ]
                    );
                    $orderRow->save();
                }
            }

            $orderId = $order->id;
        });

        if (!is_null($orderId)) {
            return self::show($orderId);
        }

        return null;
    }

    /**
     * Возвращает данные заданного заказа.
     *
     * @param    int    $orderId    ИД заказа.
     *
     * @return array
     * @throws OrderNotFound
     */
    public static function show(int $orderId): array
    {
        if (is_null($order = Order::whereId($orderId)->first())) {
            throw new OrderNotFound($orderId);
        } else {
            $data = $order->toArray();
            $data['rows'] = OrderRow::whereOrderId($order->id)
                ->get(
                    [
                        'product_id',
                        'qty',
                        'price',
                        'amount'
                    ]
                )
                ->toArray();

            return $data;
        }
    }

}
