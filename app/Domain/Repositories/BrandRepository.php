<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandRepository
{
    /**
     * @return Collection<int, Brand>
     */
    public static function all(): Collection
    {
        return self::getBrandRelationQuery()->get();
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
    private static function getBrandRelationQuery()
    {
        return Brand::query()
            ->withCount(relations: [
                'products'
            ]);
    }
}
