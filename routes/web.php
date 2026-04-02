<?php

use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CreatePasswordController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderConfirmationController;
use App\Http\Controllers\User\OrderHistoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\User\AccountInfoController;
use App\Http\Controllers\User\ReviewsController;
use Illuminate\Support\Facades\Route;

// link auto load web ''
Route::group(['prefix' => ''], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/index', [HomeController::class, 'index']);
});

Route::group(['prefix' => 'shop'], function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::get('/index', [ShopController::class, 'index']);
    Route::get('/index/filter', [ShopController::class, 'filter']);
    Route::get('/index/search', [ShopController::class, 'search']);
});

Route::group(['prefix' => 'contact'], function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::get('/index', [ContactController::class, 'index']);
});

Route::group(['prefix' => 'tracking'], function () {
    Route::get('/', [TrackingController::class, 'index']);
    Route::get('/index', [TrackingController::class, 'index']);
    Route::get('/search', [TrackingController::class, 'search']);
});

Route::group(['prefix' => 'login'], function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::get('/index', [LoginController::class, 'index']);
    Route::post('/postLogin', [LoginController::class, 'postLogin']);
    Route::get('/getLogout', [LoginController::class, 'getLogout']);
    Route::get('/index-admin', [LoginAdminController::class, 'index']);
    Route::post('/postLoginAdmin', [LoginAdminController::class, 'postLoginAdmin']);
    Route::get('/getLogoutAdmin', [LoginAdminController::class, 'getLogoutAdmin']);
});

Route::group(['prefix' => 'register'], function () {
    Route::get('/', [RegisterController::class, 'index']);
    Route::get('/index', [RegisterController::class, 'index']);
    Route::post('/insertUser', [RegisterController::class, 'insertUser']);
});

Route::group(['prefix' => 'details',], function () {
    Route::get('/', [DetailsController::class, 'index']);
    Route::get('/index', [DetailsController::class, 'index']);
    Route::post('/addProductToCart', [DetailsController::class, 'addProductToCart']);
    Route::post('/reply', [DetailsController::class, 'reply']);
});

Route::group(['prefix' => 'cart',], function () {
    Route::get('/', [CartController::class, 'index']);
    Route::get('/index', [CartController::class, 'index']);
    Route::get('/add/{product}/{quantity}', [CartController::class, 'addToCart']);
    Route::post('/add/{product}', [CartController::class, 'postAddToCart']);
    Route::get('/minus/{product}', [CartController::class, 'minusToCart']);
    Route::get('/delete/{product}', [CartController::class, 'deleteToCart']);
    Route::get('/clear', [CartController::class, 'clearCart']);
    Route::post('/addOrder', [CartController::class, 'addOrder']);
});

Route::group(['prefix' => 'order-confirmation',], function () {
    Route::get('/', [OrderConfirmationController::class, 'index']);
    Route::get('/index', [OrderConfirmationController::class, 'index']);
});

Route::group(['prefix' => 'create-password',], function () {
    Route::get('/', [CreatePasswordController::class, 'index']);
    Route::get('/index', [CreatePasswordController::class, 'index']);
    Route::post('/post-create', [CreatePasswordController::class, 'postCreate']);
});

Route::group(['prefix' => 'user', 'middleware' => 'userMiddleware'], function () {
    Route::group(['prefix' => '/',], function () {
        Route::get('/order-history', [OrderHistoryController::class, 'index']);
        Route::get('/order-history/cancel', [OrderHistoryController::class, 'cancelOrder']);
        Route::post('/order-history/review', [OrderHistoryController::class, 'review']);
        Route::get('/account-info', [AccountInfoController::class, 'index']);
        Route::post('/account-info/update', [AccountInfoController::class, 'update']);
        Route::get('/reviews', [ReviewsController::class, 'index']);
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'adminMiddleware'], function () {
    Route::group(['prefix' => '/',], function () {
        Route::get('/index', [HomeAdminController::class, 'index']);
        Route::get('/order', [OrderAdminController::class, 'index']);
        Route::get('/order/update', [OrderAdminController::class, 'update']);
        Route::post('/order/confirm', [OrderAdminController::class, 'confirm']);
        Route::post('/order/cancel', [OrderAdminController::class, 'cancel']);
        Route::get('/comment', [CommentAdminController::class, 'index']);
        Route::post('/comment/reply', [CommentAdminController::class, 'reply']);
        Route::get('/user', [UserAdminController::class, 'index']);
        Route::post('/user/insert', [UserAdminController::class, 'insert']);
        Route::get('/user/updateuser', [UserAdminController::class, 'updateuser']);
        Route::post('/user/processupdateuser', [UserAdminController::class, 'processupdateuser']);
        Route::get('/product', [ProductAdminController::class, 'index']);
        Route::get('/product/search', [ProductAdminController::class, 'search']);
        Route::get('/product/update', [ProductAdminController::class, 'updateproduct']);
        Route::post('/product/processupdateproduct', [ProductAdminController::class, 'processupdateproduct']);
        Route::get('/product/addproduct', [ProductAdminController::class, 'addproduct']);
        Route::post('/product/processaddproduct', [ProductAdminController::class, 'processaddproduct']);
        Route::get('/product/processdeleteproduct', [ProductAdminController::class, 'processdeleteproduct']);
    });
});
