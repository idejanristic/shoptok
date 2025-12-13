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
    <div id="app">
        <products-content />
    </div>
@endsection
