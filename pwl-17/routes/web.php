<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;

Route::get('/', [PageController::class, 'index']);

Route::get('/hello', function () {
    return 'Hello World';
});

Route::get('/world', function () {
    return 'World ';
});

Route::get('/about', [PageController::class, 'about']);

Route::get('/user/{name?}', function ($name='John') {
    return 'Nama saya '.$name;
});


Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

Route::get('/articles/{id}', [PageController::class, 'articles']);

Route::get('/user/profile', function() {
    //
    })->name('profile');

Route::get('/hello', [WelcomeController::class,'hello']);

Route::resource('photos', PhotoController::class)-> except([
    'create','store','update', 'edit'
]);

Route::resource('photos', PhotoController::class)-> only([
    'index','show'
]);
