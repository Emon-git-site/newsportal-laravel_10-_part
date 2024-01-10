<?php

use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\districtController;
use App\Http\Controllers\backend\divisionController;
use App\Http\Controllers\backend\subcategroyController;

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


Route::view('/', 'auth.login');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



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

// subCategory group route
Route::prefix('/subcategory/')->name('subcategory.')->group(function(){
    Route::get('index', [subcategroyController::class, 'index' ])->name('index');
    Route::post('index', [subcategroyController::class, 'store' ])->name('store');
    Route::get('index/{id}', [subcategroyController::class, 'destroy' ])->name('delete');
    Route::post('index/{id}', [subcategroyController::class, 'update' ])->name('update');
    
    // ajax purpose
    Route::get('subcategoryDataShow', [subcategroyController::class, 'subcategoryDataShow' ]);
    Route::get('subcategoryDataSho/{id}', [subcategroyController::class, 'edit' ]);
    Route::put('subcategoryDataSho/{id}', [subcategroyController::class, 'update' ]);

});
// division group route
Route::prefix('/division/')->name('division.')->group(function(){
    Route::get('index', [divisionController::class, 'index' ])->name('index');
    Route::post('index', [divisionController::class, 'store' ])->name('store');
    Route::get('index/{id}', [divisionController::class, 'destroy' ])->name('delete');
    Route::post('index/{id}', [divisionController::class, 'update' ])->name('update');
    
    // ajax purpose
    Route::get('divisionDataShow', [divisionController::class, 'divisionDataShow' ]);
    Route::get('divisionDataSho/{id}', [divisionController::class, 'edit' ]);
    Route::put('divisionDataSho/{id}', [divisionController::class, 'update' ]);

});
// distric group route
Route::prefix('/district/')->name('district.')->group(function(){
    Route::get('index', [districtController::class, 'index' ])->name('index');
    Route::post('index', [districtController::class, 'store' ])->name('store');
    Route::get('index/{id}', [districtController::class, 'destroy' ])->name('delete');
    Route::post('index/{id}', [districtController::class, 'update' ])->name('update');
    
    // ajax purpose
    Route::get('districtDataShow', [districtController::class, 'districDataShow' ]);
    Route::get('districtDataSho/{id}', [districtController::class, 'edit' ]);
    Route::put('districtDataSho/{id}', [districtController::class, 'update' ]);

});