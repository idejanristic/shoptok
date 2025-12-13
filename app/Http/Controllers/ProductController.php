<?php

namespace App\Http\Controllers;

use App\Domain\Dtos\PageDto;
use App\Domain\Dtos\SortDto;
use App\Domain\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
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

        return view(
            view: 'pages.products.index',
            data: [
                'products' => $products,
                'total' => $products->total(),
                'shops' => 0
            ]
        );
    }


    public function ajax(
        Request $request,
        ProductRepository $productRepository
    ): JsonResponse {
        $products = $productRepository->getProducts(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $request->perPage ?? 40,
                    'page' =>  $request->page ?? 1
                ]
            ),
            sortDto: SortDto::apply(data: [
                'sortBy' => 'created_at',
                'sortDir' => 'desc'
            ])
        );

        return response()
            ->json(data: $products);
    }
}
