<?php

use Illuminate\Support\Facades\Route;

Auth::routes();


Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::post('/slugger', 'HomeController@slugger')->name('slugger');
        Route::get('/posts/my-posts', 'PostController@myindex')->name('posts.myindex');
        Route::resource('/posts', 'PostController');
    });

Route::get("{any?}", function() {
    return view("guests.home");
})->where("any", ".*");
