<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::get('posts', function () {
    return [
        'status' => 'success',
        'result' => 'Ciao API Laravel'
    ];
}); */

/* Route::get('posts', function () {
    return Post::all();
});
 */


Route::get('posts', function () {
    return response()->json([
        'success' => true,
        'fabio' => 'fabio',
        'result' => Post::with('category', 'tags')->orderByDesc('id')->paginate(12)
    ]);
});

Route::get('categories', function () {
    return response()->json([
        'status' => 'success',
        'result' => App\Models\Category::all()
    ]);
});


Route::get('tags', function () {
    return response()->json([
        'status' => 'success',
        'result' => App\Models\Tag::all()
    ]);
});
