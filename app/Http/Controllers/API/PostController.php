<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Post::with('category', 'tags')->orderByDesc('id')->paginate(12)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {


        $post = Post::with('category', 'tags')->where('slug', $slug)->first();
        if ($post) {
            return response()->json([
                'success' => true,
                'result' => $post
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Ops! Page not found'
            ]);
        }
    }

    public function latest()
    {
        return response()->json([
            'success' => true,
            'result' => Post::with('category', 'tags')->orderByDesc('id')->take(3)->get()
        ]);
    }
}
