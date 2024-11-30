@extends('partials.layout')
@section('title', $post->title)
@section('content')
    @include('partials.post-card', ['full' => true])
    <h1 class="text-2xl">Comments:</h1>
    <div class="mt-2 shadow-xl card bg-base-100">
        <div class="card-body">
            <form action="{{ route('comment', ['post' => $post]) }}" method="POST">
                @csrf
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Comment</span>
                    </div>
                    <textarea name="body" rows="8" class="textarea textarea-bordered @error('body') textarea-error @enderror" placeholder="Write something cool...">{{ old('body') }}</textarea>
                    <div class="label">
                        @error('body')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </label>
                <button class="btn btn-primary">Comment</button>
            </form>
        </div>
    </div>
    @foreach($post->comments()->latest()->get() as $comment)
        <div class="mt-2 shadow-xl card bg-base-100">
            <div class="card-body">
                <p>{{ $comment->body }}</p>
                <p class="text-neutral-content">{{ $comment->created_at->diffForHumans() }}</p>
                <p class="text-info-content">
                    {{ $comment->user->name }}
                </p>
            </div>
        </div>
    @endforeach
@endsection
