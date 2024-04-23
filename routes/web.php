<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\usuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Login Controller
Route::get('/', [loginController::class, 'index']);
Route::get('/sair', [loginController::class, 'logout']);
Route::post('/login', [loginController::class, 'logar']);


//Usuario Controller
Route::get('/menu', [usuarioController::class, 'index']);
Route::get('/buscarComanda', [usuarioController::class, 'buscarComandaIndex']);
Route::get('/adicionarItem/{comanda}',[usuarioController::class, 'adicionarItemIndex']);
Route::get('/comanda/{comanda}',[usuarioController::class,'comandaIndex']);
Route::post('/buscarComanda', [usuarioController::class, 'buscarComanda']);
Route::post('/adicionarItem/{comanda}',[usuarioController::class,'adicionarItem']);
Route::delete('/cancelPed',[usuarioController::class, 'cancelPed']);
