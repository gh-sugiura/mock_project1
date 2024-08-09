<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::middleware("auth")->group(function () {
    Route::get("/", [AttendanceController::class, "get_index"]);
});
Route::get("/attendance", [AttendanceController::class, "get_attendance"]);
Route::post("/start_work", [AttendanceController::class, "start_work"]);
Route::post("/finish_work", [AttendanceController::class, "finish_work"]);
Route::post("/start_rest", [AttendanceController::class, "start_rest"]);
Route::post("/finish_rest", [AttendanceController::class, "finish_rest"]);
Route::post("/search_day_back", [AttendanceController::class, "search_day_back"]);
Route::post("/search_day_forward", [AttendanceController::class, "search_day_forward"]);
Route::get("/login", [AttendanceController::class, "get_login"]) -> name("login");
Route::get("/register", [AttendanceController::class, "get_register"]);


// fortifyのルーティングを利用
// Route::post("/", [AttendanceController::class, "post_index"]);
// Route::post("/register", [AttendanceController::class, "post_register"]);
// Route::post("/logout", [AttendanceController::class, "post_logout"]);


?>