<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\RecipesController;

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

Route::get('/', [HomeController::class, 'index']);

Route::prefix('ricette')->group(function () {
    Route::get('/', [RecipesController::class, 'macro']);

    Route::get('/{category}', [RecipesController::class, 'category']);

    Route::get('/{category}/{recipe}', [RecipesController::class, 'recipe']);
});

Route::prefix('ingredienti')->group(function () {
    Route::get('/', [IngredientsController::class, 'ingredients']);

    Route::get('/{url}', [IngredientsController::class, 'detailIngredient']);
});

Route::get('/database', function() {return view('CRUD.create');});
Route::get('/database/ingredienti', [IngredientsController::class, 'getListIngredient'])->name('databaseIngredients');
Route::post('/database/ingredienti', [IngredientsController::class, 'insertIngredient']);
Route::get('/database/ingredienti/{url}', [IngredientsController::class, 'getDescription'])->name('databaseDescription');
Route::post('/database/ingredienti/{url}', [IngredientsController::class, 'insertIngredientDescription']);
Route::get('/database/macro', [RecipesController::class, 'getMacro']);
Route::post('/database/macro', [RecipesController::class, 'insertMacro']);
Route::get('/database/categorie', [RecipesController::class, 'getCategories']);
Route::get('/database/ricette', [RecipesController::class, 'getRecipes']);
Route::get('/riccardo', function () {
    return view('riccardo');
});
