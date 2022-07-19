<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
Route::get('/ClearAll', function(){
   Artisan::call('config:cache');
    echo "Config cleared<br>"; 
});

Route::get('Authentication', function () {
    return view('pages.frontend.authentication');
})->name('Authentication');

Auth::routes();
Route::middleware(['auth'])->group(function () {

    Route::get('/', [FrontController::class, 'index'])->name('/');
    Route::get('SingleCategory/{id}', [FrontController::class, 'showCompany']);
    Route::get('SingleCompany/{id}', [FrontController::class, 'showModel']);
    Route::get('SingleModel/{id}', [FrontController::class, 'showProduct']);
    Route::get('ProductInfo/{id}', [FrontController::class, 'showProductInfo']);
    Route::get('Cart', [FrontController::class, 'showCart']);
    Route::get('Checkout', [FrontController::class, 'showCheckout']);
    Route::post('addCart', [FrontController::class, 'addCart'])->name('addCart');
    Route::post('DelCartItem', [FrontController::class, 'destroy'])->name('DelCartItem');
    Route::post('updateCart', [FrontController::class, 'update'])->name('updateCart');
    Route::post('PlaceOrder', [FrontController::class, 'saveOrder'])->name('PlaceOrder');
    Route::get('OrderPlaced', [FrontController::class, 'showOrder'])->name('OrderPlaced');

});

Route::group(['middleware' => 'admin'], function () {
    Route::get('Dashboard', function () {
        return view('pages.index');
    })->name('Dashboard');
    Route::get('Users', [CompanyController::class, 'show']);

    //==========================Products Part========================================
    Route::get('Products/{id}', [CategoryController::class, 'show']);
    Route::get('delProducts', [CategoryController::class, 'destroyProduct'])->name('delProducts');
    Route::get('product/{id}/edit', [CategoryController::class, 'editProduct']);
    Route::get('Product/{id}', [CategoryController::class, 'showProduct']);
    Route::post('saveProd', [CategoryController::class, 'storeProduct'])->name('saveProd');
    Route::post('updProd', [CategoryController::class, 'update'])->name('updProd');
    //==========================End Products Part====================================

    //==========================Categories Part========================================
    Route::get('Categories', function () {
        return view('pages.products.categories');
    });
    Route::resource('category', CategoryController::class);
    Route::post('mainCat', [CategoryController::class, 'storeMainCat'])->name('mainCat');
    Route::get('delCategory/{id}', [CategoryController::class, 'destroy']);
    Route::get('cats/{id}/edit', [CategoryController::class, 'edit']);
    Route::post('updCategory', [CategoryController::class, 'updateCategory'])->name('updCategory');
    //==========================End Categories Part====================================

    //==========================Companies Part====================================
    Route::get('Company/{id}', [CompanyController::class, 'create']);
    Route::get('Companies/{id}', [CompanyController::class, 'index']);
    Route::get('company/{id}/edit', [CompanyController::class, 'edit']);
    Route::resource('company', CompanyController::class);
    Route::get('delCompany', [CompanyController::class, 'destroy'])->name('delCompany');

    Route::get('Banners', [CompanyController::class, 'showBanner']);
    Route::get('Banner', function () {
        return view('pages.company.banner');
    });
    Route::post('storeBanner', [CategoryController::class, 'storeBanner'])->name('storeBanner');
    Route::post('updBanner', [CategoryController::class, 'updateBanner'])->name('updBanner');
    Route::get('delBanner/{id}', [CategoryController::class, 'destroyBan']);
    Route::get('banner/{id}/edit', [CategoryController::class, 'editBanner']);

    Route::get('Models/{id}', [CompanyController::class, 'showModels']);
    Route::get('Model/{id}', [CompanyController::class, 'displayModel']);
    Route::post('AddModel', [CompanyController::class, 'storeModel'])->name('AddModel');
    Route::post('UpdateModel', [CompanyController::class, 'updModel'])->name('UpdateModel');
    Route::get('delModels', [CompanyController::class, 'destroyModel'])->name('delModels');
    Route::get('models/{id}/edit', [CompanyController::class, 'editModel']);
    Route::post('fetchModel', [CompanyController::class, 'fetchModel'])->name('fetchModel');
    
    Route::get('Orders', [CompanyController::class, 'Orders'])->name('Orders');
    Route::get('rejectOrder', [CompanyController::class, 'RejectOrder'])->name('rejectOrder');
    Route::get('acceptOrder', [CompanyController::class, 'AcceptOrder'])->name('acceptOrder');
    //==========================End Companies Part====================================

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
