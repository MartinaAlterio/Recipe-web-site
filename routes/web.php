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

    Route::get('/ingredienti/{url}', [IngredientsController::class, 'getDescription'])->name('databaseDescription');

    Route::post('/ingredienti/{url}', [IngredientsController::class, 'insertIngredientDescription']);

    Route::get('/ricette', [RecipesController::class, 'getRecipesDatabase'])->name('databaseRecipe');

    Route::post('/ricette', [RecipesController::class, 'crudRecipes']);

    Route::get('/{recipe}/ingredienti', [RecipesController::class, 'getIngredientsRecipeDatabase'])->name('databaseRecipeIngredients');

    Route::post('/{recipe}/ingredienti', [RecipesController::class, 'crudRecipesIngredients']);

    Route::get('/{recipe}/procedimenti', [RecipesController::class, 'getMethodsRecipeDatabase'])->name('databaseRecipeMethods');

    Route::post('/{recipe}/procedimenti', [RecipesController::class, 'crudRecipesMethods']);

    Route::get('/{recipe}/collegamenti', [RecipesController::class, 'getLinkedRecipesDatabase'])->name('databaseRecipeslinked');

    Route::post('/{recipe}/collegamenti', [RecipesController::class, 'crudRecipesLinked']);

    Route::get('/categorie', [RecipesController::class, 'getCategoriesDatabase'])->name('databaseCategories');

    Route::post('/categorie', [RecipesController::class, 'crudCategories']);

    Route::get('/categorie/ricette/{category}', [RecipesController::class, 'getCategoriesRecipesDatabase'])->name('databaseCategoriesRecipes');

    Route::post('/categorie/ricette/{category}', [RecipesController::class, 'crudCategoriesRecipes']);

    Route::get('/categorie/collegamenti/{category}', [RecipesController::class, 'getCategoriesLinkedDatabase'])->name('databaseCategoriesLinked');

    Route::post('/categorie/collegamenti/{category}', [RecipesController::class, 'crudCategoriesLinked']);
});



Route::get('/MartinaAlterio', function () {
    return view('martina');
});
