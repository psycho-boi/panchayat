<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomepageController;

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
//     return view('homapage');
// });


// Route::get('/', 'HomepageController@index');

Route::get('/', [App\Http\Controllers\HomepageController::class, 'index']);


Route::get('/form', function () {
    return view('form');
});

Route::get('/user_registration', function(){
    return view('user_registration');
});

Route::get('/about_us', function(){
    return view('about_us');
});


// Route::get('form', function(){
//     return view('form');
// })->name("form");




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

