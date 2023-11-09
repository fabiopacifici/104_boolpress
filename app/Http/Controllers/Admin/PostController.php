<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::orderByDesc('id')->paginate(12);
        //dd($posts);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //dd($request->all());

        // validate the user input
        $val_data = $request->validated();
        //dd($val_data);

        // generate the post slug
        $val_data['slug'] = Str::slug($request->title, '-');


        // add the cover image if passed in the request
        if ($request->has('cover_image')) {
            $path = Storage::put('posts_images', $request->cover_image);
            $val_data['cover_image'] = $path;
        }

        //dd($val_data);
        // create the new article
        Post::create($val_data);
        return to_route('admin.posts.index')->with('message', 'Post Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //

        //dd($post);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        //dd($request->all(), $post, $post->getOriginal('title'), Str::is($post->getOriginal('title'), $request->title));


        // validate
        $val_data = $request->validated();

        // update the image
        if ($request->has('cover_image')) {
            $path = Storage::put('posts_images', $request->cover_image);
            $val_data['cover_image'] = $path;
        }


        // update the slug if the request has a title key
        if (!Str::is($post->getOriginal('title'), $request->title)) {

            // NB: shuld check if it exists
            // update the post slug
            $val_data['slug'] = $post->generateSlug($request->title);
        }



        //dd($val_data);
        // update
        $post->update($val_data);
        // redirect
        return to_route('admin.posts.index')->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //

        if ($post->cover_image) {
            Storage::delete($post->cover_image);
        }

        $post->delete();
        return to_route('admin.posts.index')->with('message', 'Post deleted successfully');
    }
}
