@extends('partials.layout')
@section('title', 'Home')
@section('content')
    <div class="my-4 text-center">
        {{ $posts->links() }}
    </div>
    <div class="grid grid-cols-4 gap-2">
        @foreach ($posts as $post)
            @include('partials.post-card')
        @endforeach
    </div>
@endsection
