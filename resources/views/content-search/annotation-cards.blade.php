<div class="ui blurring">
    <div class="ui inverted card-dimmer dimmer">
        <div class="ui large text loader">Loading</div>
    </div>
    <div class="ui four doubling stackable special cards">
        @foreach($annotations as $annotation)
            {{--Modal for Expand--}}
            @include('content-search.card-modal')
            {{--Card For Annotation--}}
            @include('content-search.card')
        @endforeach
    </div>
</div>
<br>
{{--Pagination--}}
<div class="ui one column centered grid">
    <div class="middle aligned column">
        {!! $annotations->appends(['active_labels' => $active_labels])->setPath('/')->render(new Landish\Pagination\SemanticUI($annotations))  !!}
    </div>
</div>
