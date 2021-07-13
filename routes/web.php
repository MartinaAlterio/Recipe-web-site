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
    Route::get('/', [RecipesController::class, 'getMacro']);

    Route::get('/{category}', [RecipesController::class, 'getCategory']);

    Route::get('/{category}/{recipe}', [RecipesController::class, 'getRecipe']);
});

Route::prefix('ingredienti')->group(function () {
    Route::get('/', [IngredientsController::class, 'getIngredients']);

    Route::get('/{url}', [IngredientsController::class, 'getDetailIngredient']);
});

Route::prefix('database')->group(function () {
    Route::get('/', function() {return view('CRUD.create');});

    Route::get('/ingredienti', [IngredientsController::class, 'getListIngredient'])->name('databaseIngredients');

    Route::post('/ingredienti', [IngredientsController::class, 'insertIngredient']);

    Route::get('/ingrediente/{url}', [IngredientsController::class, 'getDescription'])->name('databaseDescription');

    Route::post('/ingrediente/{url}', [IngredientsController::class, 'insertIngredientDescription']);

    Route::get('/macro', [RecipesController::class, 'getMacroDatabase'])->name('databaseMacro');

    Route::post('/macro', [RecipesController::class, 'insertMacroDatabase']);

    Route::get('/categorie', [RecipesController::class, 'getCategoriesDatabase'])->name('databaseCategory');

    Route::post('/categorie', [RecipesController::class, 'insertCategoriesDatabase']);

    Route::get('/ricette', [RecipesController::class, 'getRecipesDatabase'])->name('databaseRecipe');

    Route::post('/ricette', [RecipesController::class, 'CRUDrecipe']);

    Route::get('/{recipe}/ingredienti', [RecipesController::class, 'getIngredientsRecipeDatabase'])->name('databaseRecipeIngredients');

    Route::post('/{recipe}/ingredienti', [RecipesController::class, 'CRUDrecipeIngredients']);
});



Route::get('/MartinaAlterio', function () {
    return view('martina');
});
