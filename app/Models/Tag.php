<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

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
