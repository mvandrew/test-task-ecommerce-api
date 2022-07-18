<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderRow
 *
 * @Class OrderRow Строка заказа покупателя.
 * @package App\Models
 * @property int $id
 * @property int $order_id Заказ покупателя.
 * @property int $product_id Товар.
 * @property int $qty Заказанное количество.
 * @property string $price Цена за единицу товара.
 * @property string $amount Сумма заказа по строке.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderRow whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 */
class OrderRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'amount'
    ];

    /**
     * Заказ покупателя по строке.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Товар в строке.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
