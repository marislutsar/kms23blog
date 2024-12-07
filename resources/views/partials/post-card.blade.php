<div class="shadow-xl card bg-base-100">
    @if ($post->images)
        @if($post->images->count() === 1)
            <figure>
                <img src="{{$post->images->first()->url}}"/>
            </figure>
        @else
            <div class="w-full carousel">
                @foreach($post->images as $key=>$image)
                    <div id="image_{{$image->id}}" class="relative w-full carousel-item">
                        <img src="{{$image->url}}" class="w-full" />
                        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                            <a href="#image_{{$post->images[$key-1]->id ?? $post->images->last()->id}}" class="btn btn-circle">❮</a>
                            <a href="#image_{{$post->images[$key+1]->id ?? $post->images->first()->id}}" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
    <div class="card-body">
        <h2 class="card-title">{{ $post->title }}</h2>
        @if (isset($full) && $full)
            <p>{!! $post->displayBody !!}</p>
        @else
            <p>{{ $post->snippet }}</p>
            <p class="text-neutral-content">Comments: {{ $post->comments_count }}</p>
        @endif
        @if ($post->category)
            <div class="badge badge-outline badge-primary">{{ $post->category->name }}</div>
        @else
            <div class="badge badge-outline badge-primary">Uncategorized</div>
        @endif
        <p class="text-neutral-content">Likes: {{ $post->likes_count }}</p>
        <p class="text-neutral-content">{{ $post->created_at->diffForHumans() }}</p>
        <p class="text-info-content">
            <a href="{{ route('user', ['user' => $post->user]) }}">{{ $post->user->name }}</a>
        </p>
        <div>
            @foreach ($post->tags as $tag)
                <a href="{{ route('tag', ['tag' => $tag]) }}">
                    <div class="badge badge-outline">{{ $tag->name }}</div>
                </a>
            @endforeach
        </div>
        <div class="justify-end card-actions">
            <form action="{{ route('like', ['post' => $post]) }}" method="POST">
                @csrf
                @if ($post->authHasLiked)
                    <button class="btn btn-error">Unlike</button>
                @else
                    <button class="btn btn-secondary">Like</button>
                @endif
            </form>
            @if (!isset($full) || !$full)
                <a href="{{ route('post', ['post' => $post]) }}" class="btn btn-primary">Read more</a>
            @endif
        </div>
    </div>
</div>
