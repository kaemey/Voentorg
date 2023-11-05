<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\RMVC\Route\Route;

//Не использовать роут '/'

Route::get('/home', [HomeController::class, 'index']);

Route::get('/category/{ctg_id}', [CategoryController::class, 'show_ctg']);
Route::get('/subcategory/{ctg_id}/{subctg_id}', [CategoryController::class, 'show_subctg']);
Route::get('/product/{ctg_id}/{subctg_id}/{product_id}', [CategoryController::class, 'show_product']);


Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/category', [AdminController::class, 'category_create']);
Route::post('/admin/category', [CategoryController::class, 'category_store']);
Route::get('/admin/product', [AdminController::class, 'product_create']);
Route::post('/admin/product', [AdminController::class, 'product_store']);

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/reg', [HomeController::class, 'reg'])->name('reg');
Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/news', [HomeController::class, 'news']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/user/reg', [UserController::class, 'reg']);
Route::post('/user/login', [UserController::class, 'login']);

Route::get('/api/getSubcategories/{ctg_id}', [ApiController::class, 'getSubcategories']);