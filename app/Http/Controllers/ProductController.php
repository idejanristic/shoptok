<?php

namespace App\Http\Controllers;

use App\Domain\Dtos\PageDto;
use App\Domain\Dtos\Products\ProductFilterDto;
use App\Domain\Dtos\SortDto;
use App\Domain\Repositories\BrandRepository;
use App\Domain\Repositories\CategoryRepository;
use App\Domain\Repositories\ProductRepository;
use App\Domain\Repositories\TagRepository;
use App\Domain\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @param ProductRepository $productRepository
     * @return View
     */
    public function index(
        Request $request,
        ProductRepository $productRepository
    ): View {
        $products = $productRepository->getProducts(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => 40,
                    'page' =>  $request->page ?? 1
                ]
            ),
            sortDto: SortDto::apply(data: [
                'sortBy' => 'created_at',
                'sortDir' => 'desc'
            ])
        );

        $brands = BrandRepository::all();
        $tags = TagRepository::all();

        return view(
            view: 'pages.products.index',
            data: [
                'products' => $products,
                'total' => $products->total(),
                'brands' => $brands,
                'tags' => $tags
            ]
        );
    }

    /**
     * @param Request $request
     * @param ProductRepository $productRepository
     * @param ProductService $productService
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(
        Request $request,
        ProductRepository $productRepository,
        ProductService $productService
    ): JsonResponse {

        $sortData = $productService->formatSortByParametar(sortBy: $request->sortBy);

        $products = $productRepository->getProducts(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $request->perPage ?? 40,
                    'page' =>  $request->page ?? 1
                ]
            ),
            filters: ProductFilterDto::apply(
                data: [
                    'brandIds' => $request->brands,
                    'tagIds' => $request->tags
                ]
            ),
            sortDto: $sortData
        );

        return response()
            ->json(data: $products);
    }

    public function category(
        int $id,
    ): View {
        $category = CategoryRepository::find(id: $id);

        $brands = BrandRepository::all(categoryId: $category->id);
        $tags = TagRepository::all(categoryId: $category->id);

        return view(
            view: 'pages.products.category',
            data: [
                'category' => $category,
                'brands' => $brands,
                'tags' => $tags
            ]
        );
    }

    public function categoryAjax(
        int $id,
        Request $request,
        ProductRepository $productRepository,
        ProductService $productService
    ): HttpJsonResponse {

        $sortData = $productService->formatSortByParametar(sortBy: $request->sortBy);

        $products = $productRepository->getProducts(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $request->perPage ?? 40,
                    'page' =>  $request->page ?? 1
                ]
            ),
            filters: ProductFilterDto::apply(
                data: [
                    'categoryId' => $id,
                    'brandIds' => $request->brands,
                    'tagIds' => $request->tags
                ]
            ),
            sortDto: $sortData
        );

        return response()
            ->json(data: $products);
    }
}
