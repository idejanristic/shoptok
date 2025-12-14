<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandRepository
{
    /**
     * @return Collection<int, Brand>
     */
    public static function all(?int $categoryId = null): Collection
    {
        return self::getBrandRelationQuery(categoryId: $categoryId)->get();
    }

    /**
     * @param string $name
     * @return Brand|null
     */
    public function findOrCreateByName(string $name): ?Brand
    {
        if (empty($name)) {
            return null;
        }

        $brand = Brand::where(column: 'name', operator: $name)->first();

        if (!$brand) {
            $brand = Brand::create(attributes: [
                'name' => $name,
            ]);
        }

        return $brand;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Brand>
     */
    private static function getBrandRelationQuery(?int $categoryId = null)
    {
        return Brand::query()
            ->withCount([
                'products as products_count' => function ($query) use ($categoryId) {
                    if ($categoryId) {
                        $query->where('category_id', $categoryId);
                    }
                }
            ])
            ->orderBy(column: 'products_count', direction: 'desc');
    }
}
