<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

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
    return view('frontend.master_front');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => '\App\Http\Controllers\LanguageController@switchLang']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/myprofile', [App\Http\Controllers\HomeController::class, 'profile'])->name('user.profile');
Route::get('/product/all_products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');




Route::post('/product/save', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
Route::get('/product/{id}/detail', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/product/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
Route::get('/print/{id}', 'PrintController@print')->name('print');

Route::patch('/customer/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update_customer');
Route::get('/fetchRate',[App\Http\Controllers\ProductController::class, 'fetchRate']);
Route::get('/fetchPrice',[App\Http\Controllers\ProductController::class, 'fetchPrice']);

Route::delete('/customer/delete/{id}',[App\Http\Controllers\ProductController::class, 'destroy'])->name('delete_customer');

Route::get('/Staff/staff-list', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');
Route::get('/Staff/add-staff', [App\Http\Controllers\StaffController::class, 'create'])->name('staff.create');
Route::patch('/Staff/update-staff/{id}', [App\Http\Controllers\StaffController::class, 'update'])->name('staff.update');
Route::delete('/Staff/delete/{id}', [App\Http\Controllers\StaffController::class, 'destroy'])->name('staff.delete');
Route::post('/Staff/save', [App\Http\Controllers\StaffController::class, 'store'])->name('staff.store');

Route::get('/Transacton/payment', [App\Http\Controllers\TranscationController::class, 'index'])->name('transaction.view_deposit');
Route::get('/Transacton/history', [App\Http\Controllers\TranscationController::class, 'transaction_history'])->name('transaction.view_history');
Route::get('/Transaction/reports', [App\Http\Controllers\TranscationController::class, 'reports'])->name('transaction.report');

Route::get('/packages/received-packages/list', [App\Http\Controllers\ProductController::class, 'received_package'])->name('received_package.list');
Route::get('/receive-packages/{id}', [App\Http\Controllers\ProductController::class, 'receive_package'])->name('receive.package');



Route::get('/fallback', [App\Http\Controllers\HomeController::class, 'fallback'])->name('fallback');
});