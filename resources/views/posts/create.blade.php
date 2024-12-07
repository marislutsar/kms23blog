@extends('partials.layout')
@section('title', 'New Post')
@section('content')
    <div class="w-2/3 mx-auto card bg-base-300">
        <div class="card-body">
            <h2 class="card-title">New Post</h2>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">Title</span>
                    </div>
                    <input name="title" type="text" placeholder="Title" value="{{ old('title') }}" class="w-full input input-bordered @error('title') input-error @enderror" />
                    <div class="label">
                        @error('title')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Content</span>
                    </div>
                    <textarea name="body" rows="12" class="textarea textarea-bordered @error('body') textarea-error @enderror" placeholder="Write something cool...">{{ old('body') }}</textarea>
                    <div class="label">
                        @error('body')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </label>
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">Images</span>
                    </div>
                    <input name="images[]" multiple type="file" accept="image/*" class="w-full file-input file-input-bordered @error('images.*') file-input-error @enderror" />
                    <div class="label">
                        @error('images.*')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </label>
                <label class="w-full max-w-xs form-control">
                    <div class="label">
                      <span class="label-text">Tags</span>
                    </div>
                    <select name="tags[]" size="{{$tags->count()}}" multiple class="select select-bordered @error('tags.*') select-error @enderror">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                    <div class="label">
                        @error('tags.*')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                  </label>
                <input type="submit" class="btn btn-primary" value="Create">
            </form>
        </div>
    </div>
@endsection
