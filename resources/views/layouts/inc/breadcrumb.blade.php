<ol class="breadcrumb breadcrumb-bg-cyan">
    @foreach($PageResponse->breadcrumb as $item)
        @if($item['route'] != NULL)
            <li><a href="{{$item['route']}}"> {{$item['text']}}</a></li>
        @else
            <li class="active"> {{$item['text']}}</li>
        @endif
    @endforeach
</ol>