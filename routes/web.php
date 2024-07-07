<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InscricaoController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/login');
});

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::get('/logout', function () {

    auth()->logout();
    Session()->flush();
    
    return redirect('/login');
});

Auth::routes();

/**
 * Para função de resetar password
 */
Route::get('/reset', function () { return view('auth.reset'); })->name('reset');
Route::post('/reset-pass', 'App\Http\Controllers\UserController@resetPass')->name('reset-pass'); 
Route::get('/new-passwd/{token}', 'App\Http\Controllers\UserController@newPasswd')->name('new-passwd'); 
Route::post('/save-newpasswd', 'App\Http\Controllers\UserController@saveNewPasswd')->name('save-newpasswd'); 

Route::get('/reset-pass', function () {
    return view("auth.reset");
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
        return view('application.dashboard');
    });
    
    Route::prefix('/application')->group(function(){
        Route::resource('/users', 'App\Http\Controllers\UserController');
        Route::resource('/products', 'App\Http\Controllers\ProductController');
        Route::resource('/categories', 'App\Http\Controllers\CategoryController');
        Route::resource('/profile', 'App\Http\Controllers\ProfileController');
    });
    
});


