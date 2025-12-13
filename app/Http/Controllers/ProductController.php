<?php

namespace App\Http\Controllers;

use App\Domain\Dtos\PageDto;
use App\Domain\Dtos\SortDto;
use App\Domain\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
                'total' => 10,
                'shops' => 3
            ]
        );
    }
}
