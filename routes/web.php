<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollaboratorsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\StoredDataController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentRecordsController;
use App\Http\Controllers\PublicController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::resource('/collaborators',CollaboratorsController::class);
Route::post('/collaborators/accept/{collaborator}',[CollaboratorsController::class,'acceptPending'])->name('collaborators.accept');
Route::resource('/comments',CommentsController::class);

Route::get('/public/{storage}/{folder}/share',[PublicController::class,'publicShare'])->name('folders.share');
Route::get('/folders/shared',[FolderController::class,'sharedFolders'])->name('folders.shared');
Route::resource('/folders',FolderController::class);
Route::get('/folders/create/{storage?}',[FolderController::class,'create'])->name('folders.create');
Route::get('/folders/{folder}/collaborators',[CollaboratorsController::class,'folderCollaboratorsIndex'])->name('folders.show.collaborators.index');
Route::get('/folders/{folder}/collaborators/create',[CollaboratorsController::class,'create'])->name('folders.show.collaborators.create');

Route::get('/storages/dashboard',[StorageController::class,'storageDashboard'])->name('storages.dashboard');
Route::resource('/storages',StorageController::class);
Route::get('/storages/{storage}/folders/',[FolderController::class,'indexFoldersOfStorage'])->name('storage.folders.index');

Route::resource('/data',StoredDataController::class);
Route::resource('/packages',PackageController::class);
Route::get('/profile',[HomeController::class,'profile'])->name('profile');
Route::get('/profile/edit',[HomeController::class,'profile'])->name('profile.edit');
Route::post('/profile/update',[HomeController::class,'updateProfile'])->name('profile.update');
Route::get('/payment/edit',[HomeController::class,'profile'])->name('payment.edit');
Route::post('/payment/update',[HomeController::class,'updatePayment'])->name('payment.update');
Route::get('/payment/records',[PaymentRecordsController::class,'index'])->name('payment.index');

Route::get('/packages/{package}',[PackageController::class,'BuyPackage'])->name('package.buy');
// Route::resource('/teams',TeamController::class);






Route::get('/recover',[StoredDataController::class,'recoverIndex'])->name('recover.index');
Route::post('/recover/{data}',[StoredDataController::class,'recoverOne'])->name('recover.one');
Route::delete('/recover/{data}',[StoredDataController::class,'recoverDelete'])->name('recover.delete');
Route::delete('/recover',[StoredDataController::class,'deleteAll'])->name('recover.delete.all');

Route::get('/download/{data}',[StoredDataController::class,'downloadFile'])->name('download');
// Route::resource('/')
Auth::routes();

Route::get('/login-with-google',function( ){
    return view('welcome');
})->name('login.with.google');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
