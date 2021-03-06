@extends('app')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    @include('page-header')

    <div class="ui stackable grid">
        <div class="fourteen wide column">
            <select name="labels" class="ui fluid search dropdown" multiple="">
                @foreach($labels as $label)
                    <option value="{{ $label }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="two wide column">
            <button class="fluid ui clear button">Clear</button>
        </div>
    </div>

    <br>
    <div id="annotation-content">
        @include('content-search.annotation-cards')
    </div>

@endsection

@section('footer')
    <script src="{{ asset('js/all.js') }}"></script>
@endsection