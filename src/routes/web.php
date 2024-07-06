<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;


Route::get('/', [AttendanceController::class, 'index']);
Route::get('/register', [AttendanceController::class, 'register']);
Route::get('/login', [AttendanceController::class, 'login']);
Route::post('/login', [AttendanceController::class, 'store']);
Route::get('/attendance', [AttendanceController::class, 'attendance']);


?>