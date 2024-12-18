<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ReportRoleController;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/myprofile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/myprofile', [ProfileController::class, 'update'])->name('user.updateprofile');
    Route::get('/myprofile/deleteavatar', [ProfileController::class, 'deleteavatar'])->name('user.deleteavatar');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('user.changepassword');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('user.updatepassword');

    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::resource('report', ReportController::class);
    Route::get('report/{report}/print', [ReportController::class, 'print'])->name('report.print');

    Route::get('reviewer-report', [ReportRoleController::class, 'reviewer'])->name('report.reviewer');
    Route::put('reviewer-report/{id}/{status}', [ReportRoleController::class, 'review_process'])->name('report.review_process');

    Route::get('approver-report', [ReportRoleController::class, 'approver'])->name('report.approver');
    Route::put('approver-report/{id}/{status}', [ReportRoleController::class, 'approval_process'])->name('report.approval_process');

    Route::post('master/department/generatesection/{id}', [DepartmentController::class, 'generatesection'])->name('department.generatesection');

});

Route::group(['middleware' => 'admin'], function () {

    Route::group(['prefix' => 'master'], function () {
        Route::resource('department', DepartmentController::class);
        Route::resource('section', SectionController::class);
        Route::resource('user', UserController::class);
    });

    Route::get('admin-report', [ReportRoleController::class, 'admin'])->name('report.admin');

});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authuser');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
