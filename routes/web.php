<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', HomeController::class, 'index');
Route::get('/about', function () {
    return view('about');
});
// Route::get('/any', function () {
//     return view('nani', [
//         'posts' => Post::all()
//     ]);
// });
Route::get('/detail', function () {
    return view('profile.detail-profile');
});

Route::resource('comments', CommentController::class)->only(['store', 'update', 'destroy'])->middleware('auth');
Route::resource('chats', ChatController::class)->except(['update', 'edit', 'destroy', 'create'])->middleware('auth');
Route::resource('replies', ReplyController::class)->only('store')->middleware('auth');


Route::resource('posts', PostController::class)->only('show');

Route::middleware('auth')->group(function () {
    Route::get('/posts{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::patch('/posts{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard', [
        'posts' => Post::latest()->get()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users/{user:name}', function (User $user) {
    return view('users-posts', [
        'posts' => $user->posts
    ]);
})->name('user.posts');
// Route::get('/profile/{profile}', ProfileController::class, 'show')->name('profile.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/{user:name}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/github/redirect', [GithubController::class, 'redirect'])->name('github.login');
Route::get('/auth/github/callback', [GithubController::class, 'callback']);
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);



require __DIR__ . '/auth.php';
