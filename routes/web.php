<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'home'])->name('user.home');
Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/login', [UserController::class, 'loginStore'])->name('user.login.store');
Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/register', [UserController::class, 'registerStore'])->name('user.register.store');
Route::get('/logout', [UserController::class, 'logOut'])->name('user.logout');


Route::group(['middleware' => 'auth'], function () {
 //Products Routes
Route::get('/product', [ProductController::class, 'index'])->name('user.product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('user.product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('user.product.store');
Route::get('/product/fetch', [ProductController::class, 'fetchProduct'])->name('user.product.fetch');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('user.product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('user.product.update');
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('user.product.delete');

//User_Profile Routes
Route::get('/user_profile', [UserController::class, 'userProfile'])->name('user.content.user_profile');
Route::get('/user_profile/edit/{id}', [UserController::class, 'profileEdit'])->name('user.user_profile.edit');
Route::post('/user_profile/update/{id}', [UserController::class, 'profileUpdate'])->name('user.user_profile.update');
Route::delete('/user_profile/delete/{id}', [UserController::class, 'profileDestroy'])->name('user.user_profile.delete');

});


