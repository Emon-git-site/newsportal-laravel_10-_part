<?php

use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\districtController;
use App\Http\Controllers\backend\divisionController;
use App\Http\Controllers\backend\galleryController;
use App\Http\Controllers\backend\postController;
use App\Http\Controllers\backend\settingController;
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

// post group route

Route::prefix('/post/')->name('post.')->group(function(){
    Route::get('index', [postController::class, 'index'])->name('index');
    Route::get('create', [postController::class, 'create'])->name('create');
    Route::post('store', [postController::class, 'store'])->name('store');
    Route::get('edit/{id}', [postController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [postController::class, 'update'])->name('update');
    Route::get('delete/{id}', [postController::class, 'destroy'])->name('delete');


    // ajax purpose
    Route::get('subcategoryDatashow/{id}', [postController::class, 'getSubcategory']);
    Route::get('districtDatashow/{id}', [postController::class, 'getDistrict']);
});

// social setting route
Route::get('setting/social', [settingController::class, 'socialSetting'])->name('setting.social');
Route::post('setting/social/update/{id}', [settingController::class, 'updateSocial'])->name('setting.social.update');

// seo setting route
Route::get('setting/seo', [settingController::class, 'seoSetting'])->name('setting.seo');
Route::post('setting/seo/update/{id}', [settingController::class, 'updateSeo'])->name('setting.seo.update');

// prayer setting route
Route::get('setting/namaz', [settingController::class, 'namazSetting'])->name('setting.namaz');
Route::post('setting/namaz/update/{id}', [settingController::class, 'updatenamaz'])->name('setting.namaz.update');

// livetv setting route
Route::get('setting/livetv', [settingController::class, 'livetvSetting'])->name('setting.livetv');
Route::post('setting/livetv/update/{id}', [settingController::class, 'updatelivetv'])->name('setting.livetv.update');
Route::get('setting/livetv/active/{id}', [settingController::class, 'activeLivetv'])->name('setting.livetv.active');
Route::get('setting/livetv/deactive/{id}', [settingController::class, 'deactiveLivetv'])->name('setting.livetv.deactive');

// notice setting route
Route::get('setting/notice', [settingController::class, 'noticeSetting'])->name('setting.notice');
Route::post('setting/notice/update/{id}', [settingController::class, 'updatenotice'])->name('setting.notice.update');
Route::get('setting/notice/active/{id}', [settingController::class, 'activenotice'])->name('setting.notice.active');
Route::get('setting/notice/deactive/{id}', [settingController::class, 'deactivenotice'])->name('setting.notice.deactive');

// important website
Route::get('setting/website', [settingController::class, 'websiteSetting'])->name('setting.website');
Route::post('setting/website/store', [settingController::class, 'store'])->name('setting.website.store');
Route::get('setting/website/delete/{id}', [settingController::class, 'destroy']);


// ajax purpose
Route::get('website/websiteDataShow', [settingController::class, 'websiteDataShow']);
Route::get('website/websiteDataSho/{id}', [settingController::class, 'edit']);
Route::put('website/update/{id}', [settingController::class, 'update']);

// gallery group route
Route::prefix('gallery/')->name('gallery.')->group(function(){
    // photo setting
    Route::get('photo', [galleryController::class, 'photo'])->name('photo');
    Route::post('photo/storePhoto', [galleryController::class, 'storePhoto'])->name('photo.storePhoto');
    Route::get('photo/editPhoto/{id}', [galleryController::class, 'editPhoto'])->name('photo.editPhoto');
    Route::post('photo/update/{id}', [galleryController::class, 'update'])->name('photo.update');
    Route::get('photo/delete/{id}', [galleryController::class, 'destroyPhoto'])->name('photo.delete');

    // video setting
    Route::get('video', [galleryController::class, 'video'])->name('video');
    Route::post('video/store', [galleryController::class, 'store'])->name('video.store');
    Route::get('video/edit', [galleryController::class, 'edit'])->name('video.edit');
    Route::post('video/update/{id}', [galleryController::class, 'update'])->name('video.update');
    Route::get('video/delete/{id}', [galleryController::class, 'destroy'])->name('video.delete');
});