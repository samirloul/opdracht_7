@if ($paginator->hasPages())
    <nav class="pager" role="navigation" aria-label="Paginatie">
        <p class="pager-meta">
            Showing
            <strong>{{ $paginator->firstItem() }}</strong>
            to
            <strong>{{ $paginator->lastItem() }}</strong>
            of
            <strong>{{ $paginator->total() }}</strong>
            results
        </p>

        <ul class="pager-list">
            @if ($paginator->onFirstPage())
                <li><span class="is-disabled">Previous</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="is-disabled">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="is-active">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
            @else
                <li><span class="is-disabled">Next</span></li>
            @endif
        </ul>
    </nav>
@endif
