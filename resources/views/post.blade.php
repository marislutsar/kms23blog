@extends('partials.layout')
@section('title', $post->title)
@section('content')
    <div class="shadow-xl card bg-base-100">
        @if($post->displayImage)
            <figure>
                <img src="{{ $post->displayImage }}"/>
            </figure>
        @endif
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p>{!! $post->displayBody !!}</p>
            <div class="justify-end card-actions">

            </div>
        </div>
    </div>
@endsection
