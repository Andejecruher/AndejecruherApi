<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\UserController;

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
// Ruta para refrescar el token de acceso
Route::post('/refresh-token', [AuthController::class, 'refreshToken'])->middleware('auth:sanctum');
// Ruta para cerrar sesión
Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('log')->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'articulos'], function () {
    Route::get('/', [ArticuloController::class, 'index']);
    Route::get('/{id}', [ArticuloController::class, 'show']);
    Route::post('/', [ArticuloController::class, 'store']);
    Route::put('/{id}', [ArticuloController::class, 'update']);
    Route::delete('/{id}', [ArticuloController::class, 'destroy']);
});

Route::group(['prefix' => 'tags'], function () {
    Route::get('/', [TagController::class, 'index']);
    Route::get('/{id}', [TagController::class, 'show']);
    Route::post('/', [TagController::class, 'store']);
    Route::put('/{id}', [TagController::class, 'update']);
    Route::delete('/{id}', [TagController::class, 'destroy']);
});

Route::group(['prefix' => 'comentarios'], function () {
    Route::get('/', [ComentarioController::class, 'index']);
    Route::get('/{id}', [ComentarioController::class, 'show']);
    Route::post('/', [ComentarioController::class, 'store']);
    Route::put('/{id}', [ComentarioController::class, 'update']);
    Route::delete('/{id}', [ComentarioController::class, 'destroy']);
});

Route::group(['prefix' => 'categorias'], function () {
    Route::get('/', [CategoriaController::class, 'index']);
    Route::get('/{id}', [CategoriaController::class, 'show']);
    Route::post('/', [CategoriaController::class, 'store']);
    Route::put('/{id}', [CategoriaController::class, 'update']);
    Route::delete('/{id}', [CategoriaController::class, 'destroy']);
});

Route::post('/enviar-mensaje',[EmailsController::class, 'enviarMensaje'])->name('enviar-mensaje')->middleware('guest');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password')->middleware('guest');
