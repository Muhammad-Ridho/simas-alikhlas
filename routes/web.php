<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:pimpinan'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

 
/*------------------------------------------
--------------------------------------------
All Kabag Sarpras Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:kabagSarpras'])->group(function () {
  
    Route::get('/kabag-sarpras/home', [HomeController::class, 'kabangSarprasHome'])->name('kabagSarpras.home');
});


/*------------------------------------------
--------------------------------------------
All Pengelola Cabang Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:pengelolaCabang'])->group(function () {
  
    Route::get('/pengelola-cabang/home', [HomeController::class, 'pengelolaCabangHome'])->name('pengelolaCabang.home');
});
