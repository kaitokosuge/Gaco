<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/',[ArticleController::class,'index'])->name('index.article');
Route::get('/article/{article}',[ArticleController::class,'show'])->name('show.article');
Route::get('/profile/{user}',[ProfileController::class,'show'])->name('show.profile');

Route::middleware('auth')->group(function () {
    //article作成関連
    Route::get('/create',[ArticleController::class,'create'])->name('create.article');
    Route::post('/store',[ArticleController::class,'store'])->name('store.article');
    Route::get('/article/edit/{article}',[ArticleController::class,'edit'])->name('edit.article');
    Route::put('/article/edit/{article}',[ArticleController::class,'update'])->name('update.article');   
    Route::delete('/article/delete/{article}',[ArticleController::class,'destroy'])->name('destroy.article'); 

    //comment
    Route::post('/article/comment/{id}',[CommentController::class,'store'])->name('comment.article');

    //follow
    Route::post('/folllow/{user}',[ProfileController::class,'follow'])->name('follow');
    Route::delete('/unfollow/{user}',[ProfileController::class,'unfollow'])->name('unfollow');

    //like
    Route::post('/like',[LikeController::class,'like'])->name('like');
    //Route::post('/unlike/{id}',[LikeController::class,'unlike'])->name('unlike');

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
