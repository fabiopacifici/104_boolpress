<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TagController;
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

Route::get('posts', [PostController::class, 'index']);
Route::get('posts/latest', [PostController::class, 'latest']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);


Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category:slug}', [CategoryController::class, 'show']);

Route::get('tags', [TagController::class, 'index']);
Route::get('tags/{tag:slug}', [TagController::class, 'show']);


Route::post('/contacts', [LeadController::class, 'store']);
