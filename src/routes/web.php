<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::middleware('auth')->group(function () {
    Route::get('/', [AttendanceController::class, 'get_index']);
});   
Route::get('/register', [AttendanceController::class, 'get_register']);
Route::get('/login', [AttendanceController::class, 'get_login']);
Route::get('/attendance', [AttendanceController::class, 'get_attendance']);


// fortifyのルーティングを利用
// Route::post('/', [AttendanceController::class, 'post_index']);
// Route::post('/register', [AttendanceController::class, 'post_register']);
// Route::post('/logout', [AttendanceController::class, 'post_logout']);


?>