<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Category
 *
 * @Class Category Категория каталога товаров.
 * @package App\Models
 * @property int $id
 * @property string $name Наименование категории товаров.
 * @property int|null $category_id Родительская категория товаров.
 * @property string|null $vendor_url Ссылка на сайте поставщика.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereVendorUrl($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property-read Category|null $category
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'vendor_url'
    ];

    /**
     * Родительская категория каталога товаров.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Дочерние категории каталога товаров.
     *
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Товары в составе категории.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Перечень родительских категорий в иерархии подчинённости каталога товаров.
     *
     * @return \Generator
     */
    public function parentCategories(): \Generator
    {
        $category = $this;
        while (!is_null($category)) {
            if (!$category->is($this)) {
                yield $category;
            }

            $category = $category->category;
        }
    }

}
