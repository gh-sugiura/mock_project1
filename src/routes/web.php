<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;


// UserController
Route::get("/register", [UserController::class, "get_register"]);
Route::get("/login", [UserController::class, "get_login"])->name("login");


// AttendanceController
Route::post("/start_work", [AttendanceController::class, "post_start_work"]);
Route::post("/finish_work", [AttendanceController::class, "post_finish_work"]);


// RestController
Route::post("/start_rest", [RestController::class, "post_start_rest"]);
Route::post("/finish_rest", [RestController::class, "post_finish_rest"]);


// "auth" => \App\Http\Middleware\Authenticate::class,
Route::middleware("auth")->group(function () {
    Route::get("/", [AttendanceController::class, "get_index"]);
    Route::get("/attendance_date", [AttendanceController::class, "get_attendance_date"]);
    Route::get("/attendance_user", [AttendanceController::class, "get_attendance_user"]);
    Route::get("/register_user", [UserController::class, "get_register_user"]);
});


// fortifyのルーティングを利用
// Route::post("/", [AttendanceController::class, "post_index"]);
// Route::post("/register", [AttendanceController::class, "post_register"]);
// Route::post("/logout", [AttendanceController::class, "post_logout"]);


?>