<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JnspengadaanController;
use App\Http\Controllers\AssetController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
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
    Route::get('/assets-view', [AssetController::class, 'index']);
    // Route::get('/transactions-view', [TransactionController::class, 'index']);
    Route::get('/reports-view', [ReportController::class, 'index']);
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['web'],['auth', 'user-access:admin' ])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::resource('users', UserController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('lokasis', LokasiController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('jnspengadaans', JnspengadaanController::class);
    Route::resource('assets', AssetController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('transactions', TransactionController::class);
});

 
/*------------------------------------------
--------------------------------------------
All Kabag Sarpras Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:kabagSarpras'])->group(function () {
  
    Route::get('/kabag/home', [HomeController::class, 'kabagSarprasHome'])->name('kabag.home');
    
});


/*------------------------------------------
--------------------------------------------
All Pengelola Cabang Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:pengelolaCabang'])->group(function () {
  
    Route::get('/pengelola/home', [HomeController::class, 'pengelolaCabangHome'])->name('pengelola.home');
});
