<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $tag = request()->route()->parameter('tag');
        if($tag){
            $this->authorize('update', $tag);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        if(request()->wantsJson() || collect(request()->route()->gatherMiddleware())->contains('api')){
            return $tags;
        }
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $tag = new Tag($request->validated());
        $tag->save();
        if(request()->wantsJson() || collect(request()->route()->gatherMiddleware())->contains('api')){
            return $tag;
        }
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        if(request()->wantsJson() || collect(request()->route()->gatherMiddleware())->contains('api')){
            return $tag;
        }
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        if(request()->wantsJson() || collect(request()->route()->gatherMiddleware())->contains('api')){
            return $tag;
        }
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        if(request()->wantsJson() || collect(request()->route()->gatherMiddleware())->contains('api')){
            return $tag;
        }
        return redirect()->back();
    }
}
