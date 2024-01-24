<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminMediaController;
use App\Http\Controllers\PostCommentsContoller;
use App\Http\Controllers\CommentRepliesContoller;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/customdash', [AdminUsersController::class, 'dashboard'])
//    ->middleware('auth')
//    ->name('customdash');

Route::get('/customdash', [AdminUsersController::class, 'dashboard'])->name('customdash');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/error100', [AdminUsersController::class, 'notAdmin']);


Route::resource('admin/users', AdminUsersController::class);
Route::resource('admin/posts', AdminPostsController::class);
Route::resource('admin/categories', AdminCategoriesController::class);
Route::resource('admin/media', AdminMediaController::class);
Route::resource('admin/comments', PostCommentsContoller::class);
Route::resource('admin/comment/replies', CommentRepliesContoller::class);

Route::get('/post/{id}', [AdminPostsController::class, 'singlePost'])->name('home.post');
Route::get('/commentcheck/{id}', [PostCommentsContoller::class, 'singleComment'])->name('home.comment');

require __DIR__.'/auth.php';
