<div class="shadow-xl card bg-base-100">
    @if($post->displayImage)
        <figure>
            <img src="{{ $post->displayImage }}"/>
        </figure>
    @endif
    <div class="card-body">
        <h2 class="card-title">{{ $post->title }}</h2>
        @if(isset($full) && $full)
            <p>{!! $post->displayBody !!}</p>
        @else
            <p>{{ $post->snippet }}</p>
            <p class="text-neutral-content">Comments: {{ $post->comments_count }}</p>
        @endif
        <p class="text-neutral-content">{{ $post->created_at->diffForHumans() }}</p>
        <p class="text-info-content">
            <a href="{{ route('user', ['user' => $post->user]) }}">{{ $post->user->name }}</a>
        </p>
        <div class="justify-end card-actions">
            @if(!isset($full) || !$full)
                <a href="{{ route('post', ['post' => $post]) }}" class="btn btn-primary">Read more</a>
            @endif
        </div>
    </div>
</div>

