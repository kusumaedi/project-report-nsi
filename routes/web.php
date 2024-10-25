<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\DepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'auth'], function () {

    Route::get('/myprofile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/myprofile', [ProfileController::class, 'update'])->name('user.updateprofile');
    Route::get('/myprofile/deleteavatar', [ProfileController::class, 'deleteavatar'])->name('user.deleteavatar');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('user.changepassword');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('user.updatepassword');

    Route::get('/', function () {
        return view('home');
    });

    Route::resource('report', ReportController::class);
    Route::get('report/{report}/print', [ReportController::class, 'print'])->name('report.print');

});

Route::group(['middleware' => 'admin'], function () {

    Route::group(['prefix' => 'master'], function () {
        Route::resource('department', DepartmentController::class);
        Route::post('department/generatesection/{id}', [DepartmentController::class, 'generatesection'])->name('department.generatesection');
        Route::resource('section', SectionController::class);
        Route::resource('user', UserController::class);
    });


});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authuser');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
