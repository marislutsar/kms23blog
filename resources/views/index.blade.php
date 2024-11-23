@extends('partials.layout')
@section('title', 'Home')
@section('content')
    <h1 class="text-6xl">Home Page</h1>
    <div class="my-4 text-center">
        {{ $posts->links() }}
    </div>
    <div class="grid grid-cols-4 gap-2">
        @foreach ($posts as $post)
            <div class="shadow-xl card bg-base-100">
                <figure>
                    <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Shoes" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{$post->title}}</h2>
                    <p>{{$post->snippet}}</p>
                    <p class="text-neutral-content">{{$post->created_at->diffForHumans()}}</p>
                    <div class="justify-end card-actions">
                        <a href="{{ route('post', ['post' => $post]) }}" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
