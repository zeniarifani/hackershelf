<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


Route::middleware('admin')->group(function(){
    Route::get('/admin/catalogue',      [ProductController::class, 'index'])->name('catalogue');
    Route::get('/admin/catalogue/{id}', [ProductController::class, 'show'])->name('admin.detail');
    Route::post('/admin/catalogue/{id}/publish', [ProductController::class, 'publish'])->name('admin.publish');
    Route::post('/admin/catalogue/{id}/reject', [ProductController::class, 'reject'])->name('admin.reject');

});

Route::get('faq', [UserController::class, 'faq'])->name('faq');
Route::get('about', [UserController::class, 'about'])->name('about');


Route::get('/', [UserController::class, 'seeHome'])->name('seeHome');

Route::get('/list/{category_id}/{product_id}', [ProductController::class, 'showdetail'])->name('showdetail');
Route::get('/list/{category_id}',[ProductController::class,'showCategory'])->name('showCategory');
Route::get('/home', [UserController::class, 'seeHome'])->name('home');
Route::post('/login',[UserController::class,'login'])->name('login');
Route::get('/login',[UserController::class,'seeLogin'])->name('seeLogin');
Route::post('/register',[UserController::class,'register'])->name('register');
Route::get('/register',[UserController::class,'seeRegister'])->name('seeRegister');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/product/add', [ProductController::class, 'add'])->name('addproduct');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/product/add', [ProductController::class, 'create'])->name('create-product');
    Route::post('/product/{product_id}/toggle-like', [ProductController::class, 'toggleLike'])->name('toggle-like');
    Route::post('/product/{product_id}/toggle-bookmark', [ProductController::class, 'toggleBookmark'])->name('toggle-bookmark');
    Route::delete('/tool/{toolId}', [UserController::class, 'deleteTool'])->name('delete-tool');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('update-profile');
});



//harusnya ga dipake 
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('edit-product');
Route::patch('/product/edit/{id}', [ProductController::class, 'update'])->name('update-product');



