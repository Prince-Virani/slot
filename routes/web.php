<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BookSlotController;
use \App\Http\Controllers\BookingController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\WhatsAppController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('about-us', function () {
    return view('about');
});

//Route::get('slot-book', function () {
//    return view('slot-booking');
//});

Route::get('slot-book',[BookingController::class,'index'])->name('slot-book.get');
Route::post('slot-book',[BookingController::class,'bookslot'])->name('slot-book');
Route::post('available-slot',[BookingController::class,'checkslot'])->name('available-slot');

Route::prefix('admin')->group(function () {
    Route::view('login', 'admin.authentication.login')->name('login');
    Route::post('login', [LoginController::class,'login'])->name('login.details');

    Route::group(['middleware' => ['auth']], function () {
        Route::prefix('dashboard')->group(function () {
            Route::view('/', 'admin.dashboard.default')->name('index');
        });
        Route::get('logout', [LoginController::class,'logout'])->name('logout');
        Route::resource('user',CustomerController::class);
        Route::post('deleteuserslot',[CustomerController::class,'deleteuserslot'])->name('deleteuserslot');
        Route::post('getData',[CustomerController::class,'getData'])->name('data.get');
        Route::post('/slots/toggle', [CustomerController::class, 'toggleSlots'])->name('slots.toggle');
        Route::get('/slots/status', [CustomerController::class, 'getSlotsStatus'])->name('slots.status');

    });

});

Route::post('/whatsapp/webhook', [WhatsAppController::class, 'handleWebhook']);


