<?php

use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("/login", [UserController::class, "login"]);
Route::post("/register", [UserController::class, "register"]);

Route::post("/notice", [NoticeController::class, "create"]);
Route::get("/notice", [NoticeController::class, "get"]);

Route::get("/notification", [NotificationController::class, "get"])->middleware(["auth:sanctum"]);
