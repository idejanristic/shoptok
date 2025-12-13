@if ($paginator->hasPages())
    <style>
        .compact-minimal {
            --primary: #555;
            --gray: #d1d5db;
            --dark-gray: #6b7280;
        }

        .compact-minimal .pagination-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .compact-minimal .nav-btn {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: white;
            border: 1px solid var(--gray);
            color: var(--dark-gray);
            text-decoration: none;
            transition: all 0.2s;
        }

        .compact-minimal .nav-btn:hover:not(.disabled) {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .compact-minimal .nav-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f9fafb;
        }

        .compact-minimal .pages {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .compact-minimal .page-item {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 0.875rem;
            text-decoration: none;
            color: var(--dark-gray);
            transition: all 0.2s;
        }

        .compact-minimal .page-item:hover:not(.active) {
            background: #f3f4f6;
            color: var(--primary);
        }

        .compact-minimal .page-item.active {
            background: var(--primary);
            color: white;
            font-weight: 600;
        }

        .compact-minimal .ellipsis {
            color: #9ca3af;
            padding: 0 4px;
            font-weight: bold;
        }
    </style>

    <div class="compact-minimal">
        <div class="pagination-wrapper">
            {{-- Strelica levo --}}
            @if ($paginator->onFirstPage())
                <span
                    class="nav-btn disabled"
                    title="Prethodna"
                >
                    ‹
                </span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    class="nav-btn"
                    title="Prethodna"
                >
                    ‹
                </a>
            @endif

            {{-- Brojevi --}}
            <div class="pages">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="ellipsis">...</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="page-item active">{{ $page }}</span>
                            @else
                                <a
                                    href="{{ $url }}"
                                    class="page-item"
                                >{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Strelica desno --}}
            @if ($paginator->hasMorePages())
                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    class="nav-btn"
                    title="Sledeća"
                >
                    ›
                </a>
            @else
                <span
                    class="nav-btn disabled"
                    title="Sledeća"
                >
                    ›
                </span>
            @endif
        </div>
    </div>
@endif
