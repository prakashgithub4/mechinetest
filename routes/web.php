<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::group(['prefix'=>'roles','namespace'=>'App\Http\Controllers'],function(){
   Route::resource('/','RoleController');
   Route::get('/delete/{id}','RoleController@destroy');
   Route::get('/edit/{id}','RoleController@edit');
   Route::post('/update/{id}','RoleController@update');
});

Route::resource('user',UserController::class);
Route::post('/user-import','UserController@create');



