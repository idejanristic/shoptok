@extends('layouts.app')

@section('page_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                    class="text-muted"
                    href="{{ route('home') }}"
                >Televizorji</a></li>
            <li
                class="breadcrumb-item active text-muted"
                aria-current="page"
            >
                {{ $category->name }}
            </li>
        </ol>
    </nav>

    <x-page-header
        :title="$category->name"
        :total="$category->products_count"
        :img="$category->image"
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
            url="{{ route(name: 'products.category.ajax', parameters: ['id' => $category->id]) }}"
            prefix="{{ $category->prefix ?? 'tv' }}"
            :brands='@json($brands)'
            :tags='@json($tags)'
        />
    </div>
@endsection
