<style>
    .pagination {
        display: flex;
        gap: 2px;
        justify-content: center;
    }

    .page-item {
        background-color: white;
        height: 40px;
        width: 40px;
    }

    .page-link{
       line-height: 40px;
       text-decoration: none;
       color:#4a7fcd;
    }

    .active {
        color: white;
        background-color: #4a7fcd;
        .page-link{
            color: white;
        }
    }

    .previous {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }

    .next {
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
    }
</style>

@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled previous" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link" aria-hidden="true">&lsaquo;</span>
        </li>
        @else
        <li class="page-item previous">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item next">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
        @else
        <li class="page-item disabled next" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link" aria-hidden="true">&rsaquo;</span>
        </li>
        @endif
    </ul>
</nav>
@endif