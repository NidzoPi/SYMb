
@if ($paginator->hasPages())
    <ul class="pagination">
     

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class=" active btn btn-dark btn-md" style="margin-left: 5px;"><span>{{ $page }}</span></li>
                    @else
                        <li style=" margin-left: 5px;"><a class="btn btn-primary btn-md" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
       
    </ul>
@endif
