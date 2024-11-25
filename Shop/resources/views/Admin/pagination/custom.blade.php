<div class="pagination">
    <ul class="pagination-list">
       
        @if($paginator->onFirstPage())
            <li class="pagination-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="pagination-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="pagination-item">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-link">&lsaquo;</a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="pagination-item disabled" aria-disabled="true"><span class="pagination-link">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li id="pag-item" class="pagination-item"><a href="{{ $url }}" class="pagination-link">{{ $page }}</a></li>
                        {{-- <li class="pagination-item active" aria-current="page"><span class="pagination-link">{{ $page }}</span></li> --}}
                    @else
                        <li id="pag-item" class="pagination-item"><a href="{{ $url }}" class="pagination-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if($paginator->hasMorePages())
            <li class="pagination-item">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-link">&rsaquo;</a>
            </li>
        @else
            <li class="pagination-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="pagination-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
    
</div>

<style>
.pagination {
    float: right;
    margin: 0 0 5px;
}

.pagination li {
    display: inline-block;
    margin: 0 2px;
}

.pagination li a {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    color: #999;
    line-height: 30px;
    border-radius: 2px !important;
    text-align: center;
    padding: 0 6px;
    text-decoration: none;
}

.pagination li a:hover {
    color: #666;
    background-color: #f5f5f5;
}

.pagination li.active a {
    background: #03A9F4;
    color: #fff;
}

.pagination li.active a:hover {
    background: #0397d6;
}

.pagination li.disabled a {
    color: #ccc;
    pointer-events: none;
}

.pagination li span {
    font-size: 16px;
    padding-top: 6px;
}

</style>