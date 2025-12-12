<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Brand;

class BrandRepository
{
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
}
