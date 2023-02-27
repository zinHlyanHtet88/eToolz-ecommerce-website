<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', [AuthController::class, 'welcome']);

Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // admin
    Route::group(['prefix' => 'admin', 'middleware' => 'adminAuth'], function () {

        // profile
        Route::get('profile/page', [AdminController::class, 'index'])->name('admin#profilePage');
        Route::get('profile/editPage', [AdminController::class, 'profileEditPage'])->name('admin#editProfilePage');

        // admin list
        Route::get('adminsList', [AdminController::class, 'adminsListPage'])->name('admin#adminsListPage');
        Route::get('adminsList/delete/{id}', [AdminController::class, 'deleteAdmins'])->name('admin#adminsDelete');

        // password
        Route::get('password/changePasswordPage', [AdminController::class, 'changePasswordPage'])->name('admin#passwordChangePage');
        Route::post('password/changePassword', [AdminController::class, 'changePassword'])->name('admin#passwordChange');

        // category
        Route::get('categoryPage', [CategoryController::class, 'listPage'])->name('admin#categoryListPage');
        Route::get('category/createPage', [CategoryController::class, 'createPage'])->name('admin#createPage');
        Route::get('category/editPage', [CategoryController::class, 'editPage'])->name('admin#editPage');
        Route::get('category/reviewPage', [CategoryController::class, 'reviewPage'])->name('admin#categoryReviewPage');


        // products
        Route::get('products/page', [ProductController::class, 'list'])->name('admin#productsPage');
        Route::get('products/addPage', [ProductController::class, 'addPage'])->name('admin#productsAddpage');
        Route::get('products/editPage', [ProductController::class, 'editPage'])->name('product#editPage');
        Route::get('products/reviewPage', [ProductController::class, 'reviewPage'])->name('admin#productReviewPage');
        Route::get('products/discountProduct', [ProductController::class, 'discountProduct'])->name('admin#discountProduct');


        // order list
        Route::get('orderList/list', [OrderListController::class, 'list'])->name('admin#orderLists');


        // order
        Route::get('order/list', [OrderController::class, 'list'])->name('admin#ordersList');

        // message
        Route::get('message/list', [MessageController::class, 'list'])->name('admin#messageList');
        Route::get('message/reply', [MessageController::class, 'replyPage'])->name('admin#messageReply');


    });

    // user
    Route::group(['prefix' => 'user'], function () {

        // profile
        Route::get('profile/edit', [UserController::class, 'editProfilePage'])->name('user#editProfile');

        Route::get('password/changePage', [UserController::class, 'passwordChangePage'])->name('user#passwordChangePage');

        // home
        Route::get('home', [UserController::class, 'userHome'])->name('user#home');

        // products
        Route::get('products/allList', [ProductController::class, 'allListPage'])->name('user#productAllList');
        Route::get('products/detail', [ProductController::class, 'productDetailPage'])->name('user#productDetailPage');

        // cart
        Route::get('cart/list', [ProductController::class, 'cartList'])->name('user#cartList');

        // notification
        Route::get('noti/orderPage', [UserController::class, 'notiOrder'])->name('user#notiOrder');
        Route::get('noti/messagePage', [UserController::class, 'messagePage'])->name('user#notiMessage');

        // contact us
        Route::get('contact/message', [UserController::class, 'contactPage'])->name('user#message');

        // service
        Route::get('service/page', [UserController::class, 'servicePage'])->name('user#servicePage');


        // about us
        Route::get('aboutUs', [UserController::class, 'aboutUsPage'])->name('user#aboutUsPage');

    });


});


