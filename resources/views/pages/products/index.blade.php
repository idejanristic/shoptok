@extends('layouts.app')

@section('page_header')
    <x-page-header
        title="Televizorji"
        :total="$total"
        :shops="$shops"
        img_src="https://img.ep-cdn.com/i/800/345/9a/9ac2cf1b62252cat_69/televizorji-akcija.webp"
    >
        <div class="d-flex flex-wrap gap-2">
            <span class="badge text-dark rounded border bg-white px-3 py-2">
                LED TV
            </span>
            <span class="badge text-dark rounded border bg-white px-3 py-2">
                OLED TV
            </span>
        </div>
    </x-page-header>
@endsection


@section('page_content')
    <div class="row">
        <div class="col-3 col-md-2">
            <div class="form-floating">
                <select
                    class="form-select"
                    id="perPage"
                >
                    <option value="40">40</option>
                    <option
                        value="32"
                        selected
                    >32</option>
                    <option value="25">24</option>
                    <option value="10">16</option>
                    <option value="5">8</option>
                </select>
                <label for="floatingSelect">na strani</label>
            </div>
        </div>
        <div class="col-4 col-md-7"></div>
        <div class="col-5 col-md-3">
            <div class="form-floating">
                <select
                    class="form-select"
                    id="sortBy"
                >
                    <option
                        value="minPrice"
                        selected
                    >
                        Cena (najprej najnižja)
                    </option>
                    <option value="maxPrice">
                        Cena (najprej najvišja)
                    </option>
                    <option value="discount">
                        Razlika v ceni
                    </option>
                    <option value="-brand">
                        Ime izdelka (Z-A)
                    </option>
                    <option value="brand">
                        Ime izdelka (A-Z)
                    </option>
                </select>

                <label for="floatingSelect">razvrsti</label>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-md-4 col-lg-3 p-2">
                <div class="card">

                    <div class="card-body">
                        <div class="card-text">
                            <img
                                src="{{ $product->image }}"
                                alt="{{ $product->name }}"
                                class="img-thumbnail mb-2"
                            />
                            <p class="text-multiline-ellipsis">
                                {{ $product->name }}
                            </p>
                            <b>{{ $product->price }} €</b>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection
