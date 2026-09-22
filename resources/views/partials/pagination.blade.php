@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="corox-pagination">
        {{-- Mobile Compact View (< 640px) --}}
        <div class="corox-pagination-mobile">
            @if ($paginator->onFirstPage())
                <span class="corox-page-btn disabled" aria-disabled="true">
                    &lsaquo; Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="corox-page-btn">
                    &lsaquo; Previous
                </a>
            @endif

            <span class="corox-page-info">
                Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
            </span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="corox-page-btn">
                    Next &rsaquo;
                </a>
            @else
                <span class="corox-page-btn disabled" aria-disabled="true">
                    Next &rsaquo;
                </span>
            @endif
        </div>

        {{-- Desktop Full View (>= 640px) --}}
        <div class="corox-pagination-desktop">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="corox-page-btn disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    &lsaquo; Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="corox-page-btn" aria-label="@lang('pagination.previous')">
                    &lsaquo; Prev
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="corox-page-numbers">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="corox-page-dots" aria-disabled="true">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="corox-page-num active" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="corox-page-num">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="corox-page-btn" aria-label="@lang('pagination.next')">
                    Next &rsaquo;
                </a>
            @else
                <span class="corox-page-btn disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    Next &rsaquo;
                </span>
            @endif
        </div>
    </nav>
@endif
