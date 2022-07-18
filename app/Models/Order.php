<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Order
 *
 * @Class Order Заказ покупателя.
 * @package App\Models
 * @property int $id
 * @property int|null $user_id Владелец заказа.
 * @property string|null $phone Номер телефона покупателя.
 * @property string|null $email Адрес электронной почты для уведомлений по заказу.
 * @property string|null $address Адрес доставки.
 * @property string|null $customer_comment Комментарий покупателя к заказу.
 * @property string|null $manager_comment Комментарий менеджера к заказу.
 * @property int $status Статус заказа.
 * @property string|null $sum_amount Сумма заказа.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereManagerComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSumAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderRow[] $orderRows
 * @property-read int|null $order_rows_count
 * @property-read \App\Models\User|null $user
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'email',
        'address',
        'customer_comment',
        'manager_comment',
        'status',
        'sum_amount'
    ];

    /**
     * Владелец заказа.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Строки заказа.
     *
     * @return HasMany
     */
    public function orderRows(): HasMany
    {
        return $this->hasMany(OrderRow::class);
    }
}
