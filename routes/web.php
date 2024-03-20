<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

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


Route::get('/form', [FormController::class, 'list'])->name('form.show');

Route::get('/sample', function () {
    return view('sample');
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

Route::get('/storage/{doc_url}', [WorkshopController::class, 'showDoc'])->name('workshop.doc');



//meeting
Route::get('/admin/meeting', [MeetingController::class, 'index'])->name('meeting.index');
Route::post('/admin/addmeeting', [MeetingController::class, 'store']) -> name('meeting.store'); 
Route::delete('/admin/deletemeeting/{id}',[MeetingController::class, 'destroy'] )->name('meeting.delete');
Route::get('/admin/createmeeting', function(){ return view('meeting.addmeeting');});


//Notice
Route::get('/admin/notice', [NoticeController::class, 'index'])->name('notice.index');
Route::post('/admin/addnotice', [NoticeController::class, 'store']) -> name('notice.store'); 
Route::delete('/admin/deletenotice/{id}',[NoticeController::class, 'destroy'] )->name('notice.delete');
Route::get('/admin/createnotice', function(){ return view('notice.addnotice');});


//Events
Route::get('/admin/event', [EventController::class, 'index'])->name('event.index');
Route::post('/admin/addevent', [EventController::class, 'store']) -> name('event.store'); 
Route::delete('/admin/deleteevent/{id}',[EventController::class, 'destroy'] )->name('event.delete');
Route::get('/admin/createevent', function(){ return view('event.addevent');});


//form
Route::get('/admin/form', [FormController::class, 'index'])->name('form.index');
Route::post('/admin/addform', [FormController::class, 'store']) -> name('form.store'); 
Route::delete('/admin/deleteform/{id}',[FormController::class, 'destroy'] )->name('form.delete');
Route::get('/admin/createform', function(){ return view('form.addform');});

Route::get('/storage/{form_url}', [FormController::class, 'showDoc'])->name('form.doc');


// //staff
Route::get('/admin/staff', [staffController::class, 'index'])->name('staff.index');
Route::post('/admin/addstaff', [staffController::class, 'store']) -> name('staff.store'); 
Route::delete('/admin/deletestaff/{id}',[staffController::class, 'destroy'] )->name('staff.delete');
Route::get('/admin/createstaff', function(){ return view('staff.addstaff');});




// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

