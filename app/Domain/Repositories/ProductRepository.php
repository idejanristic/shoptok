<?php

namespace App\Domain\Repositories;

use App\Domain\Dtos\PageDto;
use App\Domain\Dtos\ProductDto;
use App\Domain\Dtos\SortDto;
use App\Domain\Models\Category;
use App\Domain\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;

class ProductRepository
{
    /**
     * @param ProductDto $dto
     * @return Product
     */
    public function save(ProductDto $dto): Product
    {
        return Product::create(
            attributes: [
                'productId' => $dto->productId,
                'discount'  => $dto->discount,
                'name'      => $dto->name,
                'image'     => $dto->image,
                'link'      => $dto->link,
                'price'     => $dto->price,
            ]
        );
    }

    /**
     * @param Product $product
     * @param mixed $brandId
     * @return void
     */
    public function attachBrand(Product $product, $brandId): void
    {
        $product->brand()->associate(model: $brandId);
        $product->save();
    }

    /**
     * @param Product $product
     * @param array $tagIds
     * @return void
     */
    public function syncTags(Product $product, array $tagIds): void
    {
        $product->tags()->sync(ids: $tagIds);
    }

    /**
     * @param Product $product
     * @param Category $category
     * @return void
     */
    public function attachCategory(Product $product, Category $category): void
    {
        $product->category()->associate(model: $category);
        $product->save();
    }

    /**
     * @param string $productId
     * @return Product|null
     */
    public function findByProductId(string $productId): ?Product
    {
        return Product::where(column: 'productId', operator: $productId)->first();
    }

    /**
     * @param PageDto $pageDto
     * @param mixed $sortDto
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProducts(PageDto $pageDto, ?SortDto $sortDto = null): Paginator
    {
        return self::getProductsQuery(sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            )
            ->onEachSide(count: 1);
    }

    /**
     * @param mixed $sortDto
     * @return \Illuminate\Database\Eloquent\Builder<Product>
     */
    private static function getProductsQuery(?SortDto $sortDto)
    {
        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return Product::query()
            ->with(relations: 'brand')
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir);
    }
}
