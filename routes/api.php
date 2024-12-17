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
Route::get("/users", [UserController::class, "get"])->middleware("auth:sanctum");;
Route::post("/logout", [UserController::class, "logout"])->middleware("auth:sanctum");
Route::get("/verify/logged", [UserController::class, "verifyLogged"])->middleware("auth:sanctum");;
Route::patch("/refresh/token", [UserController::class, "refreshToken"]); //->middleware("auth:sanctum");

//Notices
Route::post("/notice", [NoticeController::class, "create"])->middleware(["auth:sanctum"]);
Route::get("/notices", [NoticeController::class, "get"])->middleware(["auth:sanctum"]);
//Notifications
Route::get("/notifications", [NotificationController::class, "get"])->middleware(["auth:sanctum"]);
//NotificationUsers
Route::get("notification-users", [NotificationUserController::class, "get"])->middleware(["auth:sanctum"]);
