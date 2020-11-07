<?php

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\EventosController::class, 'index']);
Route::get('/Home', [App\Http\Controllers\EventosController::class, 'index']);

Auth::routes();

//Crud
Route::get('/Homeo', [App\Http\Controllers\EventosController::class, 'ObtenerTodosEventos']);
Route::post('/Home/Create',[App\Http\Controllers\EventosController::class, 'create']);
Route::Delete('/Home/eliminar/{id}',[App\Http\Controllers\EventosController::class, 'destroy']);
Route::put('/Home/Editar/{id}', [App\Http\Controllers\EventosController::class, 'update']);

//API
Route::get('/Eventos/{id}/{fecha}', [App\Http\Controllers\EventosController::class, 'show']);
Route::get('/Eventos/{id}', [App\Http\Controllers\EventosController::class, 'showAllEvent']);
