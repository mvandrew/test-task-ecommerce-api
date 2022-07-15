<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Product
 *
 * @Class Product Товар каталога.
 * @package App\Models
 * @property int $id
 * @property string $name Наименование товара.
 * @property string|null $sku Артикул.
 * @property string|null $vendor_url Ссылка на сайте поставщика.
 * @property string|null $price Цена за единицу товара.
 * @property int $stock Остаток товара на складе.
 * @property int $in_stock Флаг наличия товара на складе.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVendorUrl($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'vendor_url',
        'price',
        'stock',
        'in_stock'
    ];

    /**
     * Обработка записи товара.
     *
     * @param    array    $options
     *
     * @return bool
     */
    public function save(array $options = []): bool
    {
        $this->in_stock = $this->stock > 0;

        return parent::save($options);
    }

    /**
     * Категории товара.
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
