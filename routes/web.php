<?php

use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\CategoryController;

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
//     return view('auth.login');
// });
Route::view('/', 'auth.login');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// categories
// Route::get('/category/index', [CategoryController::class, 'index' ])->name('category.index');
// Route::post('/category/index', [CategoryController::class, 'store' ])->name('category.store');

// category group route
Route::prefix('/category/')->name('category.')->group(function(){
    Route::get('index', [CategoryController::class, 'index' ])->name('index');
    Route::post('index', [CategoryController::class, 'store' ])->name('store');
    Route::get('index/{id}', [CategoryController::class, 'destroy' ])->name('delete');
    Route::post('index/{id}', [CategoryController::class, 'update' ])->name('update');
    
    // ajax purpose
    Route::get('categoryDataShow', [CategoryController::class, 'categoryDataShow' ]);
    Route::get('categoryDataSho/{id}', [CategoryController::class, 'edit' ]);
    Route::put('categoryDataSho/{id}', [CategoryController::class, 'update' ]);

});