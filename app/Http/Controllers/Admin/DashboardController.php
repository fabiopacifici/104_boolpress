<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{


    public function index()
    {

        $total_articles = Post::all()->count();
        $total_users = User::all()->count();

        return view('admin.dashboard', compact('total_articles', 'total_users'));
    }
}
