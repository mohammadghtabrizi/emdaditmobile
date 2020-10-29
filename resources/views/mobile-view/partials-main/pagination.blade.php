@if ($paginator->hasPages())

<nav>

    <ul class="pagination pagination-lg">
            
        @if ($paginator->onFirstPage())

            <li class="page-item">
                <a class="page-link disabled" aria-label="قبلی">
                    <span aria-hidden="true">« </span>
                    <span class="sr-only">قبلی</span>
                </a>
            </li>

        @else

            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="قبلی">
                    <span aria-hidden="true">« </span>
                    <span class="sr-only">قبلی</span>
                </a>
            </li>    

        @endif


        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))

            <li class="page-item active" aria-disabled="true"><a class="page-link" >{{ $element }}</a></li>
                                    
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
                    @else
                    
                        <li class="page-item "><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="بعد">
                    <span aria-hidden="true">» </span>
                    <span class="sr-only">بعدی</span>
                </a>
            </li>

        @else

            <li class="page-item">
                <a class="page-link disabled" aria-label="بعد">
                    <span aria-hidden="true">» </span>
                    <span class="sr-only">بعدی</span>
                </a>
            </li>

        @endif
        
    </ul>

</nav>

@endif
