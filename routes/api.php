<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReplyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(static function(){
    Route::prefix('questions')->name('question.')->group(static function(){
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::post('/', [QuestionController::class, 'store'])->name('store');
        Route::get('/{question}', [QuestionController::class, 'show'])->name('show');
        Route::patch('/{question}', [QuestionController::class, 'update'])->name('update');
        Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('categories')->name('category.')->group(static function(){
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::name('reply.')->group(static function(){
        Route::get('/question/{question}/replies', [ReplyController::class, 'index'])->name('index');
        Route::post('/question/{question}/reply', [ReplyController::class, 'store'])->name('store');
        Route::get('/question/{question}/reply/{reply}', [ReplyController::class, 'show'])->name('show');
        Route::patch('/question/{question}/reply/{reply}', [ReplyController::class, 'update'])->name('update');
        Route::delete('/question/{question}/reply/{reply}', [ReplyController::class, 'destroy'])->name('destroy');
    });

    Route::name('like.')->group(static function(){
        Route::post('/like/{reply}', [LikeController::class, 'likeIt'])->name('likeIt');
        Route::delete('/like/{reply}', [LikeController::class, 'unLikeIt'])->name('unLikeIt');
    });



});

