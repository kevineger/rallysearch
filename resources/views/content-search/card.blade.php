<div id="{{ $annotation->id }}" class="ui card">
    <div class="blurring dimmable image">
        <div class="ui inverted dimmer">
            <div class="content">
                <div class="center">
                    <a href="{{ $annotation->post_url }}" class="ui primary button">
                        <i class="reddit large icon"></i>
                        View on Reddit
                    </a>
                </div>
            </div>
        </div>
        <div class="crop">
            <img src="{{ $annotation->image_url }}">
        </div>
    </div>
    <div class="content">
        <a href="{{ $annotation->post_url }}" class="slim header">{{ str_limit($annotation->reddit_title, $limit=50, $end='...') }}</a>
        <div class="meta">
            <span>/r/{{ $annotation->reddit_sub }} - {{ $annotation->reddit_id }}</span>
        </div>
        <div class="description">
            <div id="labels{{ $annotation->id }}" class="ui lightgrey labels">
                @foreach($annotation->labels as $label)
                    <a class="ui label">{{ $label->description }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="ui two bottom attached fluid buttons">
        <div class="ui labeled icon basic expand button">
            <i class="expand icon"></i>
            Expand
        </div>
        <div class="ui right labeled icon basic similar button">
            <i class="right cubes icon"></i>
            Similar
        </div>
    </div>
</div>