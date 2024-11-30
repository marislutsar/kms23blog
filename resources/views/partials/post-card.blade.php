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
        <p class="text-neutral-content">Likes: {{ $post->likes_count }}</p>
        <p class="text-neutral-content">{{ $post->created_at->diffForHumans() }}</p>
        <p class="text-info-content">
            <a href="{{ route('user', ['user' => $post->user]) }}">{{ $post->user->name }}</a>
        </p>
        <div>
            @foreach ($post->tags as $tag)
                <a href="{{ route('tag', ['tag' => $tag]) }}">
                    <div class="badge badge-outline">{{$tag->name}}</div>
                </a>
            @endforeach
        </div>
        <div class="justify-end card-actions">
            <form action="{{ route('like', ['post' => $post]) }}" method="POST">
                @csrf
                @if($post->authHasLiked)
                    <button class="btn btn-error">Unlike</button>
                @else
                    <button class="btn btn-secondary">Like</button>
                @endif
            </form>
            @if(!isset($full) || !$full)
                <a href="{{ route('post', ['post' => $post]) }}" class="btn btn-primary">Read more</a>
            @endif
        </div>
    </div>
</div>

