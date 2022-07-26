@if ($paginator->lastPage() > 1)
<nav class="mt-4 mb-3">
    <ul class="pagination justify-content-center mb-0">
        <li class="page-item ">
            <a class="page-link first" href="{{ $paginator->url(1) }}">
                <i class="simple-icon-control-start"></i>
            </a>
        </li>
        <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="page-link prev"
               href ="@php if($paginator->currentPage() > 1) echo $paginator->url($paginator->currentPage() - 1)  @endphp">
                <i class="simple-icon-arrow-left"></i>
            </a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }} ">
            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
        @endfor
        <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a class="page-link next" href="{{ $paginator->url($paginator->currentPage()+1) }}" aria-label="Next">
                <i class="simple-icon-arrow-right"></i>
            </a>
        </li>
        <li class="page-item ">
            <a class="page-link last" href="{{  $paginator->url($paginator->lastPage()) }}">
                <i class="simple-icon-control-end"></i>
            </a>
        </li>
    </ul>
</nav>
@endif
