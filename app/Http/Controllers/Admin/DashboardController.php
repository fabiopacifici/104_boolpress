<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{


    public function index()
    {

        $total_posts = Post::where('user_id', Auth::id())->count();
        $total_categories = Category::all()->count();

        $total_users = User::all()->count();

        $total_posts_without_images = Post::where('user_id', Auth::id())->where('cover_image', null)->count();
        $total_posts_with_images = $total_posts - $total_posts_without_images;

        //dd($total_articles_with_images);

        return view('admin.dashboard', compact('total_posts', 'total_posts_without_images', 'total_posts_with_images', 'total_users', 'total_categories'));
    }
}
