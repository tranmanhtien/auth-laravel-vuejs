<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
    <ol class="breadcrumb pt-0">
        @foreach($breadcrumds['item'] as $item)
            <li class="breadcrumb-item">
                <a href="{{$item['url']}}">{{$item['name']}}</a>
            </li>
        @endforeach
        <li class="breadcrumb-item active" aria-current="page">{{$breadcrumds['item_final']}}</li>
    </ol>
</nav>
