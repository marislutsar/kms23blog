@extends('partials.layout')
@section('title', 'Posts')
@section('content')
    <a href="{{ route('posts.create') }}" class="btn btn-primary">New Post</a>
    <div class="my-4 text-center">
        {{ $posts->links() }}
    </div>
    <table class="table table-zebra">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr class="hover">
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td>
                        <div class="join">
                            <a href="{{ route('posts.show', ['post' => $post]) }}" class="join-item btn btn-info">View</a>
                            <a href="{{ route('posts.edit', ['post' => $post]) }}" class="join-item btn btn-warning">Edit</a>
                            <button form="delete-post-{{$post->id}}" class="join-item btn btn-error">Delete</button>
                        </div>
                        <form id="delete-post-{{$post->id}}" action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th>ID</th>
            <th>Title</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </tfoot>
    </table>
    <div class="my-4 text-center">
        {{ $posts->links() }}
    </div>
@endsection
