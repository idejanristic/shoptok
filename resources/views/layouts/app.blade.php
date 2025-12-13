<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Shoptok</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-body-tertiary">
    @include('partials.header')

    <header class="mb-4 bg-white shadow-sm">
        <div class="container py-3">
            @yield('page_header')
        </div>
    </header>

    <main class="container">
        <nav class="navbar navbar-light bg-light d-lg-none px-3">
            <button
                class="btn btn-primary"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar"
            >
                ☰ Filteri
            </button>
        </nav>

        <div class="row">
            <div class="col-12 d-flex">
                <!-- Desktop Sidebar -->
                <div class="sidebar-desktop d-none d-lg-block">
                    @include('partials.sidebar')
                </div>

                <!-- Main Content -->
                <div
                    class="main-content"
                    style="width: 100%;"
                >
                    @yield('page_content')
                </div>
            </div>
        </div>

        <!-- Mobile Sidebar (Bootstrap Offcanvas) -->
        <div
            class="offcanvas offcanvas-start"
            tabindex="-1"
            id="mobileSidebar"
        >
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="offcanvas"
                ></button>
            </div>
            <div class="offcanvas-body">
                @include('partials.sidebar')
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>

</html>
