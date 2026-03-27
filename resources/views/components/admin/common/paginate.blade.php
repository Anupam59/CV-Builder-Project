@if ($paginator->hasPages())

    <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="paginate_button page-item previous disabled">
                    <span class="page-link">
                        <i class="previous"></i>
                    </span>
                </li>
            @else
                <li class="paginate_button page-item previous">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                        <i class="previous"></i>
                    </a>
                </li>
            @endif


            {{-- Page Numbers Logic --}}
            @php
                $start = $paginator->currentPage() - 2;
                $end = $paginator->currentPage() + 2;

                if ($start < 1) {
                    $start = 1;
                    $end = min(5, $paginator->lastPage());
                }

                if ($end > $paginator->lastPage()) {
                    $end = $paginator->lastPage();
                }
            @endphp


            {{-- First Page + Dots --}}
            @if ($start > 1)
                <li class="paginate_button page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                </li>

                @if ($start > 2)
                    <li class="paginate_button page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif


            {{-- Main Pages --}}
            @for ($i = $start; $i <= $end; $i++)
                <li class="paginate_button page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor


            {{-- Last Page + Dots --}}
            @if ($end < $paginator->lastPage())
                @if ($end < $paginator->lastPage() - 1)
                    <li class="paginate_button page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif

                <li class="paginate_button page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                        {{ $paginator->lastPage() }}
                    </a>
                </li>
            @endif


            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="paginate_button page-item next">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <i class="next"></i>
                    </a>
                </li>
            @else
                <li class="paginate_button page-item next disabled">
                    <span class="page-link">
                        <i class="next"></i>
                    </span>
                </li>
            @endif

        </ul>
    </div>

@endif
