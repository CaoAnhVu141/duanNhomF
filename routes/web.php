<?php

use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AminLoginRegister;
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

Route::get('/', function () {
    return view('welcome');
});


//định nghĩa route show view login và register

Route::get('/register',[AminLoginRegister::class,'showRegister'])->name('admin.register');
Route::post('/register/run',[AminLoginRegister::class,'adminRegister'])->name('register.run');

Route::get('/login',[AminLoginRegister::class,'showLogin'])->name('admin.login');
Route::post('/login',[AminLoginRegister::class,'adminLogin'])->name('loginrun');


///

Route::get('/index ',[AdminUsersController::class,'showAllUsers'])->middleware('auth');

//viết route để show chi tiết thông tim users

Route::get('/detail-users/{id}',[AdminUsersController::class,'showDetailUsers'])->name('detail.users');


///viết route xoá users

Route::get('delete-users/{id}',[AdminUsersController::class,'deleteUsers'])->name('delete');

// viết route show giao diện để update

Route::get('/update-users/{id}',[AdminUsersController::class,'showEdit'])->name('update');
//-
Route::post('update-users/{id}',[AdminUsersController::class,'adminUpdate'])->name('update.users');

//viết route đăng xuất
Route::get('/logout',[AminLoginRegister::class,'logOut'])->name('logout');