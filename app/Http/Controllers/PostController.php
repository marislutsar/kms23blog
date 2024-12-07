<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Image;
use App\Models\Tag;
use Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $post = request()->route()->parameter('post');
        if($post && $post->user->id !== Auth::id()){
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->paginate();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post($request->validated());
        $post->user()->associate(Auth::user());
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');
        $post->save();
        if($request->has('images')){
            foreach($request->file('images') as $file){
                $image = new Image();
                $image->path = $file->store('', ['disk' => 'public']);
                $image->post()->associate($post);
                $image->save();
            }
        }
        if($request->has('tags')){
            foreach($request->input('tags') as $tagId){
                $post->tags()->attach($tagId);
            }
        }
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');

        // $post->fill($request->validated());
        // $post->save();
        if($request->has('images')){
            foreach($request->file('images') as $file){
                $image = new Image();
                $image->path = $file->store('', ['disk' => 'public']);
                $image->post()->associate($post);
                $image->save();
            }
        }
        $post->tags()->sync($request->input('tags'));
        $post->update($request->validated());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
