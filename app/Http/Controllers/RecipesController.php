<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Http\classes\database\ingredients\IngredientsRepository;
use App\Http\classes\database\Recipes\RecipesRepository;
use Illuminate\Support\Facades\DB;

class RecipesController extends Controller
{

    public function recipes(RecipesRepository $recipesRepository) {
        $macros = $recipesRepository->getListMacro();
        foreach ($macros as $macro) {
            $macro->categories = $recipesRepository->getCategoriesMacro($macro->id);
            foreach ($macro->categories as $category) {
                $category->recipes = $recipesRepository->getImportantRecipesCategory($category->id);
            }
        }
        echo "<pre>";
        var_dump($macros);
    }

    public function category(RecipesRepository $recipesRepository, $category) {
        $category = $recipesRepository->getCategoryUrl($category);
        $category->recipes = $recipesRepository->getRecipesCategory($category->id);
        echo "<pre>";
        var_dump($category);
    }

    public function recipe(RecipesRepository $recipesRepository, $category, $recipe) {
        $recipe = $recipesRepository->getRecipeUrl($recipe);
        $recipe->category = $recipesRepository->getcategoryUrl($category);
        echo "<pre>";
        var_dump($recipe);
    }

}
