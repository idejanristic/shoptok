<div style="padding-right: 16px;">
    <div class="filter-box mb-2">
        <div class="filter-title">
            Kategorije
        </div>
        <div class="filter-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a
                        class="nav-link px-0"
                        aria-current="page"
                        href="#"
                    >LED TV</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link px-0"
                        aria-current="page"
                        href="#"
                    >OLED TV</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="filter-box mb-2">
        <div class="filter-title">
            Proizvajalec
        </div>
        <div class="filter-body">
            <div class="filter-scroll">
                @foreach ($brands as $brand)
                    <div class="form-check mb-3">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="brand_{{ $brand->id }}"
                        >
                        <label
                            class="form-check-label"
                            for="brand_{{ $brand->id }}"
                        >
                            {{ $brand->name }}
                            <span
                                class="badge"
                                style="color: red;"
                            >
                                {{ $brand->products_count }}
                            </span>
                        </label>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="filter-box mb-2">
        <div class="filter-title">
            Tagovi
        </div>
        <div class="filter-body">
            @foreach ($tags as $tag)
                <button class="text-dark position-relative mb-2 ml-2 rounded border bg-white px-3 py-2">
                    {{ $tag->name }}

                    <span class="position-absolute translate-middle badge rounded-pill bg-danger start-10 top-0 z-10">
                        {{ $tag->products_count }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>
</div>
