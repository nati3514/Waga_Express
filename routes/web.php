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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/myprofile', [App\Http\Controllers\HomeController::class, 'profile'])->name('user.profile');
Route::get('/product/all_products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
//Route::get('/product//create-product', [App\Http\Controllers\ProductController::class, 'createProduct'])->name('products.createProduct');



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
Route::get('/Staff/reports', [App\Http\Controllers\StaffController::class, 'reports'])->name('staff.report');



Route::get('/fallback', [App\Http\Controllers\HomeController::class, 'fallback'])->name('fallback');
