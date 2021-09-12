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

    Route::post('/ingredienti', [IngredientsController::class, 'cudIngredient']);

    Route::get('/ingredienti/{url}', [IngredientsController::class, 'getDescription'])->name('databaseDescription');

    Route::post('/ingredienti/{url}', [IngredientsController::class, 'cudIngredientDescription']);

    Route::get('/ricette', [RecipesController::class, 'getRecipesDatabase'])->name('databaseRecipe');

    Route::post('/ricette', [RecipesController::class, 'cudRecipe']);

    Route::get('/{recipe}/ingredienti', [RecipesController::class, 'getRecipeIngredientsDatabase'])->name('databaseRecipeIngredients');

    Route::post('/{recipe}/ingredienti', [RecipesController::class, 'cuRecipeIngredients']);

    Route::get('/{recipe}/procedimenti', [RecipesController::class, 'getMethodsRecipeDatabase'])->name('databaseRecipeMethods');

    Route::post('/{recipe}/procedimenti', [RecipesController::class, 'cudRecipeMethod']);

    Route::get('/{recipe}/collegamenti', [RecipesController::class, 'getLinkedRecipesDatabase'])->name('databaseRecipeslinked');

    Route::post('/{recipe}/collegamenti', [RecipesController::class, 'cuRecipeLinked']);

    Route::get('/categorie', [RecipesController::class, 'getCategoriesDatabase'])->name('databaseCategories');

    Route::post('/categorie', [RecipesController::class, 'cudCategories']);

    Route::get('/categorie/ricette/{category}', [RecipesController::class, 'getCategoryRecipesDatabase'])->name('databaseCategoriesRecipes');

    Route::post('/categorie/ricette/{category}', [RecipesController::class, 'cuCategoryRecipes']);

    Route::get('/categorie/collegamenti/{category}', [RecipesController::class, 'getCategoriesLinkedDatabase'])->name('databaseCategoriesLinked');

    Route::post('/categorie/collegamenti/{category}', [RecipesController::class, 'cuCategoriesLinked']);
});



Route::get('/MartinaAlterio', function () {
    return view('martina');
});
