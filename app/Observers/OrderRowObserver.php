<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderRow;

class OrderRowObserver
{
    /**
     * Обновляет сумму по заказу с учётом сумм входящих в его состав строк.
     *
     * @param    Order    $order
     *
     * @return float
     */
    public function updateOrderSumAmount(Order &$order): float
    {
        $order->sum_amount = $order->orderRows->sum('amount');
        $order->save();

        return (float)$order->sum_amount;
    }

    /**
     * Handle the OrderRow "created" event.
     *
     * @param    OrderRow    $orderRow
     *
     * @return void
     */
    public function created(OrderRow $orderRow): void
    {
        $this->updateOrderSumAmount($orderRow->order);
    }

    /**
     * Handle the OrderRow "updated" event.
     *
     * @param    OrderRow    $orderRow
     *
     * @return void
     */
    public function updated(OrderRow $orderRow): void
    {
        $this->updateOrderSumAmount($orderRow->order);
    }

    /**
     * Handle the OrderRow "deleted" event.
     *
     * @param    OrderRow  $orderRow
     *
     * @return void
     */
    public function deleted(OrderRow $orderRow): void
    {
        $this->updateOrderSumAmount($orderRow->order);
    }

    /**
     * Handle the OrderRow "restored" event.
     *
     * @param  OrderRow  $orderRow
     *
     * @return void
     */
    public function restored(OrderRow $orderRow): void
    {
        $this->updateOrderSumAmount($orderRow->order);
    }

    /**
     * Handle the OrderRow "force deleted" event.
     *
     * @param  OrderRow  $orderRow
     *
     * @return void
     */
    public function forceDeleted(OrderRow $orderRow): void
    {
        $this->updateOrderSumAmount($orderRow->order);
    }
}
