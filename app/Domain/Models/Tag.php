<?php

namespace App\Domain\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Tag>
     */
    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The products that belong to the tag.
     *
     * @return BelongsToMany<Product, Tag>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Product::class,
            table: 'product_tag',
            foreignPivotKey: 'tag_id',
            relatedPivotKey: 'product_id'
        )
            ->withTimestamps();
    }
}
