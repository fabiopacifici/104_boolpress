<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'result' => Tag::all()
        ]);
    }



    public function show($slug)
    {
        $tag = Tag::with('posts')->where('slug', $slug)->first();
        if ($tag) {
            return response()->json([
                'success' => true,
                'result' => $tag
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Ops! Page not found'
            ]);
        }
    }
}
