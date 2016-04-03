@extends('app')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    @include('page-header')

    <div class="ui grid">
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
    <script>
        $('.special.cards .card .image').dimmer({
            on: 'hover'
        });
        $('.ui.dropdown').dropdown({
            allowAdditions: false,
            onChange: function (value, text, $selectedItem) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/filter',
                    data: {
                        labels: value
                    },
                    success: function (markup) {
                        console.log("Hello from onChange");
                        $('#annotation-content').html(markup);
                        $('.special.cards .card .image').dimmer({
                            on: 'hover'
                        });
                    }
                });
                $('.ui.dropdown').dropdown('hide');
            }
        });

        // Clear the dropdown
        $('.clear.button').on('click', function () {
            $('.ui.dropdown').dropdown('clear');
        });

        // Show the modal
        $(document.body).on('click', '.ui.labeled.expand.button', function () {
            var card_id = $(this).closest('.card').attr('id');
            $('#modal' + card_id).modal('show');
        });

        // View similarly labeled content
        $(document.body).on('click', '.ui.labeled.similar.button', function () {
            var content = $(this).parent().siblings('.content').find('.ui.labels');
            var label_list = [];
            content.children('.label').each(function() {
                var $this = $(this);
                label_list.push($this.text());
            });
            $('.ui.dropdown').dropdown('set exactly', label_list);
        });
    </script>
@endsection