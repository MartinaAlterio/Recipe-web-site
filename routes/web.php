<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\QueryRicetteController;

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

/*Route::get('/', [HomeController::class, 'index']);

Route::get('/ingredienti', [IngredientiController::class, 'list']);
Route::get('/ingredienti/{name}', [IngredientiController::class, 'dettaglio']);

Route::get('/ricette', [RicetteController::class, 'categorie']);
Route::get('/ricette/{sottocategoria}', [RicetteController::class, 'sottocategorie']);
Route::get('/ricette/sottocategoria/{name}', [RicetteController::class, 'dettaglio']);
Route::get('/listaricette', [QueryRicetteController::class, 'index']);*/

Route::get('/test1', [IngredientsController::class, 'test1']);
Route::get('/ricette', [RecipesController::class, 'recipes']);
Route::get('/ricette/{category}', [RecipesController::class, 'category']);
Route::get('/ricette/{category}/{recipe}', [RecipesController::class, 'recipe']);

