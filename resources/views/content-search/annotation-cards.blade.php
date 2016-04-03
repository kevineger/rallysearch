<div class="ui four doubling stackable special cards">
    @foreach($annotations as $annotation)
        {{--Modal for Expand--}}
        @include('content-search.card-modal')
        {{--Card For Annotation--}}
        @include('content-search.card')
    @endforeach
</div>
