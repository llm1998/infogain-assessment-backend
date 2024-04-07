<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreBookController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('/book', BookController::class)->except(['edit']);
Route::resource('/store', StoreController::class)->except(['edit']);
Route::resource('/store/{store}/book', StoreBookController::class)->except(['edit']);
