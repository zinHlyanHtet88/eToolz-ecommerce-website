<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\OrderListController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\RatingController;
use App\Http\Controllers\api\UserController;
use App\Models\Message;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// category
Route::get('category/list', [CategoryController::class, 'list']);
Route::post('category/paginate', [CategoryController::class, 'paginate']);
Route::post('category/create', [CategoryController::class, 'createCategory']);
Route::post('category/delete', [CategoryController::class, 'deleteCategory']);
Route::post('category/edit/id', [CategoryController::class, 'getCategoryWithId']);
Route::post('category/update', [CategoryController::class, 'updateCategory']);
Route::post('category/withSearchValue', [CategoryController::class, 'getCategoriesBySearchValue']);

// product
Route::post('products/create', [ProductsController::class, 'createProduct']);
Route::get('products/list', [ProductsController::class, 'list']);
Route::post('products/byCategoryName', [ProductsController::class, 'categorySearch']);
Route::post('products/delete', [ProductsController::class, 'deleteProduct']);
Route::post('products/productWithId', [ProductsController::class, 'getProductWithId']);
Route::post('products/updateProduct', [ProductsController::class, 'updateProduct']);
Route::post('products/searchProductByValue', [ProductsController::class, 'searchProductByValue']);
Route::post('products/updateWithDiscountPrice', [ProductsController::class, 'updateWithDiscountPrice']);
Route::get('products/getDiscountProducts', [ProductsController::class, 'getDiscountProducts']);
Route::get('products/sameCategoryProductsWithCount', [ProductsController::class, 'getSameCategoryProductsWithCount']);
Route::post('products/sameCategoryProductsOnClick', [ProductsController::class, 'getSameCategoryProductsOnClick']);
Route::post('products/getProductsBySorting', [ProductsController::class, 'getProductsBySorting']);

// admin
Route::post('admin/users/list', [AdminController::class, 'getUsersListByOptionSelect']);
Route::post('admin/user/delete',[AdminController::class, 'deleteUser']);
Route::post('admin/changeRole', [AdminController::class, 'changeRole']);
Route::post('admin/userSearch', [AdminController::class, 'userSearch']);
Route::post('admin/getLoggedInUserData', [AdminController::class, 'getLoggedInUserData']);
Route::post('admin/updateProfile', [AdminController::class, 'updateProfile']);
Route::post('admin/getUsersEmails', [AdminController::class, 'getUsersEmails']);

// cart
Route::post('cart/add', [CartController::class, 'addItemToCart']);
Route::post('cart/list', [CartController::class, 'cartList']);
Route::post('cart/delete', [CartController::class, 'deleteCart']);
Route::post('cart/update', [CartController::class, 'updateCart']);

// orderList
Route::post('orderList/add', [OrderListController::class, 'addOrderList']);
Route::post('orderList/list', [OrderListController::class, 'getOrderLists']);
Route::post('orderList/search', [OrderListController::class, 'searchByValue']);

// order
Route::post('order/list', [OrderController::class, 'list']);
Route::post('order/search', [OrderController::class, 'search']);
Route::post('order/updateStatus', [OrderController::class, 'statusUpdate']);
Route::post('order/delete', [OrderController::class, 'deleteOrder']);

// get user list
Route::get('users/list', [UserController::class, 'getUsers']);

// get order for notification
Route::post('noti/get', [UserController::class, 'getOrdersForNotification']);

// get user with its id
Route::post('users/user', [UserController::class, 'getUser']);

// rating
Route::post('rating/create', [RatingController::class, 'createRating']);
Route::get('rating/list', [RatingController::class, 'getRatings']);
Route::post('rating/setImages', [RatingController::class, 'setImages']);
Route::post('rating/deleteSelectedImg', [RatingController::class, 'deleteSelectedImg']);
Route::post('rating/deleteOnReload', [RatingController::class, 'deleteOnReload']);
Route::post('rating/adminReply', [RatingController::class, 'reply']);
Route::get('rating/data', [RatingController::class, 'getDatasForRating']);

// message
Route::post('message/send', [MessageController::class, 'sendMessage']);
Route::get('message/list', [MessageController::class, 'list']);
Route::post('message/getMessageWithId', [MessageController::class, 'getMessageWithId']);
Route::post('message/adminReply', [MessageController::class, 'adminReply']);
Route::post('message/getPrivateMessage', [MessageController::class, 'getPrivateMessage']);
Route::post('message/deletePrivateMessage', [MessageController::class, 'deletePrivateMessage']);

// user
Route::post('user/updateProfile', [UserController::class, 'updateProfile']);
Route::post('user/phoneValidation', [UserController::class, 'phoneValidation']);


// user password change
Route::post('user/password/change', [UserController::class, 'changePassword']);
Route::post('user/password/get', [UserController::class, 'getLoggedInUserPassword']);
