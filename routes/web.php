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
});
Route::get('/login',function(){

});

Route::resource('/collaborators',CollaboratorsController::class);
Route::resource('/comments',CommentsController::class);
Route::resource('/folders',FolderController::class);
Route::resource('/storages',StorageController::class);
Route::resource('/data',StoredDataController::class);
Route::get('/folder/create/{storage?}',[FolderController::class,'create'])->name('folders.create');
Route::get('/storages/{storage}/folders/',[FolderController::class,'indexFoldersOfStorage'])->name('storage.folders.index');

// Route::resource('/')
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
