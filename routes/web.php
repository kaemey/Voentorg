<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\RMVC\Route\Route;

//Не использовать роут '/'

Route::get('/home', [HomeController::class, 'index']);

Route::get('/category/{ctg_id}', [CategoryController::class, 'show_ctg']);
Route::get('/subcategory/{ctg_id}/{subctg_id}', [CategoryController::class, 'show_subctg']);
Route::get('/product/{ctg_id}/{subctg_id}/{product_id}', [CategoryController::class, 'show_product']);

//АДМИНКА
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/category', [AdminController::class, 'category_create']);
Route::get('/admin/category/edit/{category_id}', [CategoryController::class, 'category_edit']);
Route::post('/admin/category', [CategoryController::class, 'category_store']);
Route::post('/admin/category/edit/{category_id}', [CategoryController::class, 'category_update']);
Route::get('/admin/product', [AdminController::class, 'product_create']);
Route::get('/admin/product/edit', [AdminController::class, 'product_select']);
Route::get('/admin/product/edit/{product_id}', [AdminController::class, 'product_edit']);
Route::post('/admin/product', [AdminController::class, 'product_store']);
Route::post('/admin/product/edit/{product_id}', [AdminController::class, 'product_update']);
Route::get('/admin/user/add', [AdminController::class, 'user_add']);
Route::post('/admin/user/add', [AdminController::class, 'user_store']);
Route::get('/admin/user/edit', [AdminController::class, 'user_edit']);
Route::post('/admin/user/edit', [AdminController::class, 'user_update']);
Route::get('/admin/user/repass', [AdminController::class, 'user_repass']);
Route::post('/admin/user/repass', [AdminController::class, 'user_pass_update']);

//ОСНОВНЫЕ СТРАНИЦЫ
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/reg', [HomeController::class, 'reg'])->name('reg');
Route::get('/profile', [HomeController::class, 'profile']);
Route::post('/profile', [HomeController::class, 'profile_update']);
Route::get('/do_order', [OrderController::class, 'do_order']);
Route::post('/do_order', [OrderController::class, 'process_order']);
Route::get('/order_success/{order_id}', [OrderController::class, 'order_success']);
Route::get('/news', [HomeController::class, 'news']);

//КОНТРОЛЛЕРЫ ЮЗЕРА
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/user/reg', [UserController::class, 'reg']);
Route::post('/user/login', [UserController::class, 'login']);

Route::get('/api/getSubcategories/{ctg_id}', [ApiController::class, 'getSubcategories']);