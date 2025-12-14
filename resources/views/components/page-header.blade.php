@props(['total' => 0, 'title' => '', 'img' => ''])

<div class="my-2">
    <div class="g-0 position-relative header-box">
        <div class="header-box-content p-4">
            <h2 class="fw-bold mb-2">{{ $title }}</h2>
            <p class="text-muted mb-3">{{ $total }} izdelkov</p>
            <div>
                {{ $slot }}
            </div>
        </div>

        <div class="position-relative box-img-wrapper">
            <div class="box-fade"></div>
            <img
                src="{{ $img }}"
                alt="TV"
                class="img-fluid box-img"
            >
        </div>
    </div>
</div>
