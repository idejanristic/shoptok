@extends('layouts.app')

@section('page_header')
    <div class="my-2">
        <div class="g-0 position-relative header-box">

            <div class="header-box-content p-4">
                <h2 class="fw-bold mb-2">Televizorji</h2>
                <p class="text-muted mb-3">862 izdelkov | 14 trgovin</p>

                <div class="d-flex flex-wrap gap-2">
                    <span class="badge text-dark rounded border bg-white px-3 py-2">
                        LED TV
                    </span>
                    <span class="badge text-dark rounded border bg-white px-3 py-2">
                        OLED TV
                    </span>
                </div>
            </div>


            <div class="position-relative box-img-wrapper">
                <div class="box-fade"></div>
                <img
                    src="https://img.ep-cdn.com/i/800/345/9a/9ac2cf1b62252cat_69/televizorji-akcija.webp"
                    alt="TV"
                    class="img-fluid box-img"
                >
            </div>

        </div>
    </div>
@endsection


@section('page_content')
@endsection
