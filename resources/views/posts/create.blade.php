@extends('partials.layout')
@section('title', 'New Post')
@section('content')
    <div class="w-2/3 mx-auto card bg-base-300">
        <div class="card-body">
            <h2 class="card-title">New Post</h2>
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">Title</span>
                    </div>
                    <input type="text" placeholder="Title" class="w-full input input-bordered" />
                    <div class="label">
                        {{-- <span class="label-text-alt">Bottom Left label</span> --}}
                    </div>
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Content</span>
                    </div>
                    <textarea rows="12" class="textarea textarea-bordered" placeholder="Write something cool..."></textarea>
                    <div class="label">
                        {{-- <span class="label-text-alt">Your bio</span> --}}
                    </div>
                </label>
                <input type="submit" class="btn btn-primary" value="Create">
            </form>
        </div>
    </div>
@endsection
