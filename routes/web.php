<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\NewsController;

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


Route::get('/admin', function(){
    return view('admin.adminhome');
});




// news
Route::get('/admin/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/admin/addnews', [NewsController::class, 'store']) -> name('news.store'); 
Route::delete('/admin/deletenews/{id}',[NewsController::class, 'destroy'] )->name('news.delete');
Route::get('/admin/createnews', function(){ return view('news.addnews');});


//slider
Route::get('/admin/slider', [SliderController::class, 'index'])->name('slider.index');
Route::post('/admin/addslider', [SliderController::class, 'store']) -> name('slider.store'); 
Route::delete('/admin/deleteslider/{id}',[SliderController::class, 'destroy'] )->name('slider.delete');
Route::get('/admin/createslider', function(){ return view('slider.addslider');});


//workshop
Route::get('/admin/workshop', [WorkshopController::class, 'index'])->name('workshop.index');
Route::post('/admin/addworkshop', [WorkshopController::class, 'store']) -> name('workshop.store'); 
Route::delete('/admin/deleteworkshop/{id}',[WorkshopController::class, 'destroy'] )->name('workshop.delete');
Route::get('/admin/createworkshop', function(){ return view('workshop.addworkshop');});


//meeting
Route::get('/admin/meeting', [MeetingController::class, 'index'])->name('meeting.index');
Route::post('/admin/addmeeting', [MeetingController::class, 'store']) -> name('meeting.store'); 
Route::delete('/admin/deletemeeting/{id}',[MeetingController::class, 'destroy'] )->name('meeting.delete');
Route::get('/admin/createmeeting', function(){ return view('meeting.addmeeting');});


//Notice
Route::get('/admin/workshop', [WorkshopController::class, 'index'])->name('workshop.index');
Route::post('/admin/addworkshop', [WorkshopController::class, 'store']) -> name('workshop.store'); 
Route::delete('/admin/deleteworkshop/{id}',[WorkshopController::class, 'destroy'] )->name('workshop.delete');
Route::get('/admin/createworkshop', function(){ return view('workshop.addworkshop');});


// //scheme
// Route::get('/admin/workshop', [WorkshopController::class, 'index'])->name('workshop.index');
// Route::post('/admin/addworkshop', [WorkshopController::class, 'store']) -> name('workshop.store'); 
// Route::delete('/admin/deleteworkshop/{id}',[WorkshopController::class, 'destroy'] )->name('workshop.delete');
// Route::get('/admin/createworkshop', function(){ return view('workshop.addworkshop');});


// //staff
// Route::get('/admin/workshop', [WorkshopController::class, 'index'])->name('workshop.index');
// Route::post('/admin/addworkshop', [WorkshopController::class, 'store']) -> name('workshop.store'); 
// Route::delete('/admin/deleteworkshop/{id}',[WorkshopController::class, 'destroy'] )->name('workshop.delete');
// Route::get('/admin/createworkshop', function(){ return view('workshop.addworkshop');});




// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

