<?php

use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\NewsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DocController;
use Illuminate\Support\Facades\Route;
use Mockery\Matcher\Not;

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

Route::get('/user_registration', function(){
    return view('user_registration');
});

Route::get('/about', function(){
    return view('about_us');
})->name('about');

Route::get('/contact', function(){
    return view('contact');
})->name('contact');

Route::get('/admin', function(){
    return view('admin.adminhome');
});

Route::redirect('/admin', '/admin/workshop');


Route::fallback(function () {
    return view('404');
});


Route::get('/form', [FormController::class, 'list'])->name('form.list');

Route::get('/workshop', [WorkshopController::class, 'list'])->name('workshop.list');
Route::get('/workshop/{id}', [WorkshopController::class, 'display'])->name('workshop.display');

Route::get('/news', [NewsController::class, 'list'])->name('news.list');
Route::get('/news/{id}', [NewsController::class, 'display'])->name('news.display');

Route::get('/event', [EventController::class, 'list'])->name('event.list');
Route::get('/event/{id}', [EventController::class, 'display'])->name('event.display');

Route::get('/staff', [StaffController::class, 'list'])->name('staff.list');
// Route::get('/staff/{id}', [StaffController::class, 'display'])->name('staff.display');

Route::get('/scheme', [SchemeController::class, 'list'])->name('scheme.list');
Route::get('/scheme/{id}', [SchemeController::class, 'display'])->name('scheme.display');

Route::get('/facilities', [FacilitiesController::class, 'list'])->name('facilities.list');
Route::get('/facilities/{id}', [FacilitiesController::class, 'display'])->name('facilities.display');

// Route::get('/scheme', [SchemeController::class, 'list'])->name('scheme.list');
// Route::get('/scheme/{id}', [SchemeController::class, 'display'])->name('scheme.display');

// Route::get('/scheme', [SchemeController::class, 'list'])->name('scheme.list');
// Route::get('/scheme/{id}', [SchemeController::class, 'display'])->name('scheme.display');





// news
Route::get('/admin/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/admin/addnews', [NewsController::class, 'store']) -> name('news.store'); 
Route::delete('/admin/deletenews/{id}',[NewsController::class, 'destroy'] )->name('news.delete');

Route::put('/news/{id}/deactivate', [NewsController::class, 'deactivate'])->name('news.deactivate');
Route::get('admin/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::put('admin/news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::get('/admin/createnews', function(){ return view('news.addnews');})->name('news.create');


//slider
Route::get('/admin/slider', [SliderController::class, 'index'])->name('slider.index');
Route::post('/admin/addslider', [SliderController::class, 'store']) -> name('slider.store'); 
Route::get('/admin/createslider', function(){ return view('slider.addslider');})->name('slider.create');

Route::put('/slider/{id}/deactivate', [SliderController::class, 'deactivate'])->name('slider.deactivate');
Route::get('admin/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
Route::put('admin/slider/{id}', [SliderController::class, 'update'])->name('slider.update');




//workshop
Route::get('/admin/workshop', [WorkshopController::class, 'index'])->name('workshop.index');
Route::post('/admin/addworkshop', [WorkshopController::class, 'store']) -> name('workshop.store'); 
Route::get('/admin/createworkshop', function(){ return view('workshop.addworkshop');})->name('workshop.create');

Route::put('/workshops/{id}/deactivate', [WorkshopController::class, 'deactivate'])->name('workshop.deactivate');
Route::get('admin/workshops/{id}/edit', [WorkshopController::class, 'edit'])->name('workshop.edit');
Route::put('admin/workshops/{id}', [WorkshopController::class, 'update'])->name('workshop.update');


Route::get('/storage/{doc_url}', [WorkshopController::class, 'showDoc'])->name('workshop.doc');



//scheme
Route::get('/admin/scheme', [SchemeController::class, 'index'])->name('scheme.index');
Route::post('/admin/addscheme', [SchemeController::class, 'store']) -> name('scheme.store'); 
Route::get('/admin/createscheme', function(){ return view('scheme.addscheme');})->name('scheme.create');

Route::put('/scheme/{id}/deactivate', [SchemeController::class, 'deactivate'])->name('scheme.deactivate');
Route::get('admin/scheme/{id}/edit', [SchemeController::class, 'edit'])->name('scheme.edit');
Route::put('admin/scheme/{id}', [SchemeController::class, 'update'])->name('scheme.update');

Route::get('/storage/{scheme_doc_url}', [SchemeController::class, 'showDoc'])->name('scheme.doc');



//meeting
Route::get('/admin/facilities', [FacilitiesController::class, 'index'])->name('facilities.index');
Route::post('/admin/addfacilities', [FacilitiesController::class, 'store']) -> name('facilities.store'); 
Route::get('/admin/createfacilities', function(){ return view('facilities.addfacilities');})->name('facilities.create');

Route::put('/facilities/{id}/deactivate', [facilitiesController::class, 'deactivate'])->name('facilities.deactivate');
Route::get('admin/facilities/{id}/edit', [facilitiesController::class, 'edit'])->name('facilities.edit');
Route::put('admin/facilities/{id}', [facilitiesController::class, 'update'])->name('facilities.update');

Route::get('/admin/createfacilities', function(){ return view('facilities.addfacilities');})->name('facilities.create');


//Notice
Route::get('/admin/notice', [NoticeController::class, 'index'])->name('notice.index');
Route::post('/admin/addnotice', [NoticeController::class, 'store']) -> name('notice.store'); 
Route::delete('/admin/deletenotice/{id}',[NoticeController::class, 'destroy'] )->name('notice.delete');
Route::get('/admin/createnotice', function(){ return view('notice.addnotice');})->name('notice.create');


//Events
Route::get('/admin/event', [EventController::class, 'index'])->name('event.index');
Route::post('/admin/addevent', [EventController::class, 'store']) -> name('event.store'); 
Route::get('/admin/createevent', function(){ return view('event.addevent');})->name('event.create');

Route::put('/event/{id}/deactivate', [EventController::class, 'deactivate'])->name('event.deactivate');
Route::get('admin/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::put('admin/event/{id}', [EventController::class, 'update'])->name('event.update');

Route::get('/storage/{event_doc_url}', [EventController::class, 'showDoc'])->name('event.doc');


//form
Route::get('/admin/form', [FormController::class, 'index'])->name('form.index');
Route::post('/admin/addform', [FormController::class, 'store']) -> name('form.store'); 
Route::get('/admin/createform', function(){ return view('form.addform');})->name('form.create');

Route::put('/form/{id}/deactivate', [FormController::class, 'deactivate'])->name('form.deactivate');
Route::get('admin/form/{id}/edit', [FormController::class, 'edit'])->name('form.edit');
Route::put('admin/form/{id}', [FormController::class, 'update'])->name('form.update');

Route::get('/storage/{form_url}', [FormController::class, 'showDoc'])->name('form.doc');


// //staff
Route::get('/admin/staff', [staffController::class, 'index'])->name('staff.index');
Route::post('/admin/addstaff', [staffController::class, 'store']) -> name('staff.store'); 
Route::delete('/admin/deletestaff/{id}',[staffController::class, 'destroy'] )->name('staff.delete');
Route::get('/admin/createstaff', function(){ return view('staff.addstaff');})->name('staff.create');



Route::put('/photos/{id}/deactivate', [ImageController::class, 'deactivate'])->name('photos.deactivate');
Route::put('/docs/{id}/deactivate', [DocController::class, 'deactivate'])->name('docs.deactivate');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
