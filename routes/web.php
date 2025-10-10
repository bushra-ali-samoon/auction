<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;

// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

// Logout route
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');


Route::resource('auctions', AuctionController::class)->middleware('auth'); 


Route::post('/auctions/{auction}/bid', [BidController::class, 'store'])->name('bids.store');

Route::get('/bids/{bid}/accept', [AuctionController::class, 'acceptBid'])->name('bids.accept');
Route::view('/home', 'home')->name('home');

