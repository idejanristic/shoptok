@extends('layouts.app')

@section('page_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li
                class="breadcrumb-item active text-muted"
                aria-current="page"
            >
                Televizorji
            </li>
        </ol>
    </nav>

    <x-page-header
        title="Televizorji"
        :total="$total"
        img="https://img.ep-cdn.com/i/800/345/9a/9ac2cf1b62252cat_69/televizorji-akcija.webp"
    >
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('products.category', ['id' => 1]) }}">
                <span class="badge text-dark rounded border bg-white px-3 py-2">
                    LED TV
                </span>
            </a>
            <a href="{{ route('products.category', ['id' => 2]) }}">
                <span class="badge text-dark rounded border bg-white px-3 py-2">
                    OLED TV
                </span>
            </a>
        </div>
    </x-page-header>
@endsection


@section('page_content')
    <div id="app">
        <products-content-component
            url="{{ route('products.index.ajax') }}"
            prefix="tv"
            :brands='@json($brands)'
            :tags='@json($tags)'
        />
    </div>
@endsection
