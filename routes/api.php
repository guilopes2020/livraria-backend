<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', [BookController::class, 'index']); // Listar livros com paginação e busca
Route::post('/books', [BookController::class, 'store']); // Criar novo livro
Route::get('/books/{id}', [BookController::class, 'show']); // Visualizar um livro específico
Route::put('/books/{id}', [BookController::class, 'update']); // Atualizar um livro
Route::delete('/books/{id}', [BookController::class, 'destroy']); // Deletar um livro
