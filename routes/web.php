<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\ComplaintController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ComplaintController::class, 'index'])->name('complaint.index');
Route::get('/complaint', [ComplaintController::class, 'create'])->name('complaint.create');
Route::post('/complaint/store', [ComplaintController::class, 'store'])->name('complaint.store');
Route::get('/complaint/search', [ComplaintController::class, 'show'])->name('complaint.show');
Route::get('/complaint/search/show', [ComplaintController::class, 'search'])->name('complaint.search');

Route::get('/admin/complaint', [AdminComplaintController::class, 'index'])->middleware(['auth'])->name('admin.complaint');
Route::get('/admin/complaint/show/{id}', [AdminComplaintController::class, 'show'])->middleware(['auth'])->name('admin.complaint.show');
Route::post('/admin/complaint/update', [AdminComplaintController::class, 'update'])->name('admin.complaint.update');
Route::get('/admin/complaint/report', [AdminComplaintController::class, 'report'])->middleware(['auth'])->name('admin.complaint.report');
Route::post('/admin/complaint/export', [AdminComplaintController::class, 'export'])->middleware(['auth'])->name('admin.complaint.export');

Route::get('/get-regency', [Controller::class, 'getRegency'])->name('get.regency');
Route::get('/get-district', [Controller::class, 'getDistrict'])->name('get.district');
Route::get('/get-village', [Controller::class, 'getVillage'])->name('get.village');

require __DIR__.'/auth.php';
