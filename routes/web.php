<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

Route::get("/", [UserController::class, 'signIn'])->name('login');
Route::post("/login", [UserController::class, 'login']);
Route::post("/logout", [UserController::class, 'logout'])->name('logout');

Route::resource('tickets', TicketController::class);
