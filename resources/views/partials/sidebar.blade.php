<div style="padding-right: 16px;">
    <div class="filter-box mb-4">
        <div class="filter-title">
            Kategorije
        </div>
        <div class="filter-body">
            <ul class="nav flex-column">
                @foreach ($categories as $cat)
                    <li class="nav-item">
                        <a
                            class="nav-link px-0"
                            aria-current="page"
                            href="{{ route('products.category', ['id' => $cat->id]) }}"
                        >{{ $cat->name }} <span
                                class="badge"
                                style="color: red;"
                            >
                                {{ $cat->products_count }}
                            </span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="filter-box mb-4">
        <div class="filter-title">
            Proizvajalec
        </div>
        <div class="filter-body">
            <div class="filter-scroll">
                <brand-filter-component :brands='@json($brands)' />
            </div>
        </div>
    </div>

    <div class="filter-box mb-4">
        <div class="filter-title">
            Tagovi
        </div>
        <div class="filter-body">
            <tag-filter-component :tags='@json($tags)' />
        </div>
    </div>
</div>
