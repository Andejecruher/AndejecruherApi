<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Ruta para el login
Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login');

// Ruta para el registro de usuarios
Route::post(
    '/register',
    [AuthController::class, 'register']
)->name('register');

// Ruta para cerrar sesión
Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('log')->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
