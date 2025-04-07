<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\orderController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\Admin\mesinController;
use App\Http\Controllers\Admin\KomponenController;
use App\Http\Controllers\Admin\WipKomponenController;
use App\Http\Controllers\Admin\{adminController,dashboardController, OrderRequestController};

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

require __DIR__.'/auth.php';

Route::get('/error', function () {
    return view('pages.error'); // Buat halaman error 403
})->name('error');

Route::group(['middleware' => 'auth', 'PreventBackHistory'], function () {

// dashboard
Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

// profile
Route::get('/profile/{encryptedId}/edit' ,[profileController::class, 'index'])->name('profile.index');
Route::put('/profile/password-update' ,[profileController::class, 'updatePassword'])->name('profile.updatePassword');
Route::put('/profile/{id}' ,[profileController::class, 'update'])->name('profile.update');


Route::middleware(['AdminSuper'])->group( function(){

// crud admin
Route::resource('/admin', adminController::class);
// crud order Request
Route::resource('/order_requests', OrderRequestController::class);
Route::post('/admin/order_requests/{id}/update-status', [App\Http\Controllers\Admin\OrderRequestController::class, 'updateStatus'])->name('order_requests.updateStatus');
// crud komponen
Route::resource('/komponen', KomponenController::class);
// crud mesin
Route::resource('/mesin', mesinController::class);
// wip komponen
Route::resource('/wip_komponen', WipKomponenController::class);




});



Route::middleware(['KepalaProduksi'])->group( function(){
// crud komponen
Route::resource('/komponen', KomponenController::class);
// crud mesin
Route::resource('/mesin', mesinController::class);


});



Route::middleware(['OperatorTransfer'])->group( function(){
// crud order Request
Route::resource('/order_requests', OrderRequestController::class);
Route::post('/admin/order_requests/{id}/update-status', [App\Http\Controllers\Admin\OrderRequestController::class, 'updateStatus'])->name('order_requests.updateStatus');


});


Route::middleware(['OperatorTransferSet'])->group( function(){
// menampilkan order request
Route::get('/order', [orderController::class, 'index'])->name('order.index');
// wip komponen
Route::resource('/wip_komponen', WipKomponenController::class);



});

});
