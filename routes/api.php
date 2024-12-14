<?php

use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationUserController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Users
Route::post("/login", [UserController::class, "login"]);
Route::post("/register", [UserController::class, "register"]);
Route::get("/users", [UserController::class, "get"]);
//Notices
Route::post("/notice", [NoticeController::class, "create"]);
Route::get("/notices", [NoticeController::class, "get"]);
//Notifications
Route::get("/notifications", [NotificationController::class, "get"])->middleware(["auth:sanctum"]);
//NotificationUsers
Route::get("notification-users", [NotificationUserController::class, "get"]);
