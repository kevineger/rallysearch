<div id="modal{{ $annotation->id }}" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        {{ $annotation->reddit_id }}
    </div>
    <div class="image content">
        <div class="ui medium image">
            <img src="{{ $annotation->image_url }}">
        </div>
        <div class="description">
            <div class="ui header">{{ $annotation->reddit_title }}</div>
            <div class="ui lightgrey labels">
                @foreach($annotation->labels as $label)
                    <a class="ui label">
                        {{ $label->description }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui black deny button">
            Close
        </div>
        <a href="{{ $annotation->post_url }}" class="ui right labeled primary icon button">
            <i class="reddit large icon"></i>
            View on Reddit
        </a>
    </div>
</div>