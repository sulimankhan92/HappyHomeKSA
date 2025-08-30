<!-- resources/views/vendor/pagination/custom.blade.php -->

@if ($paginator->hasPages())
    <div class="card-body">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-primary pagin-border-primary">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">Previous</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" wire:click.prevent="gotoPage({{ $paginator->currentPage() - 1 }})">Previous</a></li>
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
                                <li class="page-item"><a class="page-link" href="{{ $url }}" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" wire:click.prevent="gotoPage({{ $paginator->currentPage() + 1 }})">Next</a></li>
                @else
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>
@endif
