<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'result' => Category::all()
        ]);
    }


    public function show($slug)
    {
        $cat = Category::with('posts')->where('slug', $slug)->first();
        if ($cat) {
            return response()->json([
                'success' => true,
                'result' => $cat
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Ops! Page not found'
            ]);
        }
    }
}
