<?php

namespace App\Domain\Repositories;

use App\Domain\Dtos\PageDto;
use App\Domain\Dtos\SortDto;
use App\Domain\Models\Product;
use App\Domain\Models\Category;
use App\Domain\Dtos\Products\ProductDto;
use App\Domain\Dtos\Products\ProductFilterDto;
use Illuminate\Contracts\Pagination\Paginator;
use App\Domain\Repositories\Filters\Products\TagFilter;
use App\Domain\Repositories\Filters\Products\BrandFilter;
use App\Domain\Repositories\Filters\Products\CategoryFilter;

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
     * @param mixed $filter
     * @param mixed $sortDto
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProducts(
        PageDto $pageDto,
        ?ProductFilterDto $filters = null,
        ?SortDto $sortDto = null
    ): Paginator {
        return self::getProductsQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            )
            ->onEachSide(count: 1);
    }

    /**
     * @param mixed $filter
     * @param mixed $sortDto
     * @return \Illuminate\Database\Eloquent\Builder<Product>
     */
    private static function getProductsQuery(
        ?ProductFilterDto $filters = null,
        ?SortDto $sortDto = null
    ) {
        if ($filters == null) {
            $filters = new ProductFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        $query = Product::query()
            ->with(relations: [
                'brand',
                'tags'
            ])
            ->tap(callback: new CategoryFilter(categoryId: $filters->categoryId))
            ->tap(callback: new BrandFilter(brandIds: $filters->brandIds))
            ->tap(callback: new TagFilter(tagIds: $filters->tagIds));

        if ($sortDto->sortBy == 'brand') {
            return $query
                ->leftJoin(table: 'brands', first: 'brands.id', operator: '=', second: 'products.brand_id')
                ->orderBy(column: 'brands.name', direction: $sortDto->sortDir)
                ->select(columns: 'products.*');
        }

        return $query
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir);
    }
}
