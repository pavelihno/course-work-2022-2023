<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return to_route('blogs.index');
});

Route::get('/home', function () {
    return to_route('blogs.index');
})->name('home');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::group(['namespace' => 'Blog'], function() {
    Route::get('/blogs', 'IndexController')->name('blogs.index');
    Route::get('/blogs/create', 'CreateController')->name('blogs.create');
    Route::post('/blogs', 'StoreController')->name('blogs.store');
    Route::get('/blogs/{blog}', 'ShowController')->name('blogs.show');
    Route::get('/blogs/{blog}/edit', 'EditController')->name('blogs.edit');
    Route::patch('/blogs/{blog}', 'UpdateController')->name('blogs.update');
    Route::delete('/blogs/{blog}', 'DestroyController')->name('blogs.destroy');
});

Auth::routes();

