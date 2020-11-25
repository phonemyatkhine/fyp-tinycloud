<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollaboratorsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\StoredDataController;


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
Route::resource('/comments',CommentsController::class);

Route::get('/folders/shared',[FolderController::class,'sharedFolders'])->name('folders.shared');
Route::resource('/folders',FolderController::class);
Route::resource('/storages',StorageController::class);
Route::resource('/data',StoredDataController::class);
Route::get('/folders/create/{storage?}',[FolderController::class,'create'])->name('folders.create');

Route::get('/storages/{storage}/folders/',[FolderController::class,'indexFoldersOfStorage'])->name('storage.folders.index');

Route::get('/recover',[StoredDataController::class,'recoverIndex'])->name('recover.index');
Route::post('/recover/{data}',[StoredDataController::class,'recoverOne'])->name('recover.one');
Route::delete('/recover/{data}',[StoredDataController::class,'recoverDelete'])->name('recover.delete');
Route::delete('/recover',[StoredDataController::class,'deleteAll'])->name('recover.delete.all');
// Route::resource('/')
Auth::routes();

Route::get('/login-with-google',function( ){
    return view('welcome');
})->name('login.with.google');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
