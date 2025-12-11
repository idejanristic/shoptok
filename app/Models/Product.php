<?php

namespace App\Models;

use Dom\ProcessingInstruction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'productId',
        'discount',
        'brand',
        'name',
        'image',
        'link',
        'price',
    ];

    /**
     * @return BelongsTo<Brand, Product>
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(related: Brand::class);
    }

    /**
     * @return BelongsTo<Category, Product>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(related: Category::class);
    }

    /**
     * @return BelongsToMany<Tag, Product>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Tag::class,
            table: 'product_tag',
            foreignPivotKey: 'product_id',
            relatedPivotKey: 'tag_id'
        )
            ->withTimestamps();
    }
}
