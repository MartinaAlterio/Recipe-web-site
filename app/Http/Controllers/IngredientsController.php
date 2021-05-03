<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Http\classes\database\ingredients\IngredientsRepository;
use App\Http\classes\database\Recipes\RecipesRepository;
use Illuminate\Support\Facades\DB;

class IngredientsController extends Controller
{
    public function ingredients(IngredientsRepository $ingredientsRepository){
        $list = $ingredientsRepository->getActiveIngredients();
        echo"<pre>";
        var_dump($list);
    }

    public function detailIngredient(IngredientsRepository $ingredientsRepository, $url) {
        $ingredient = $ingredientsRepository->getIngedientFromUrl($url);
        $ingredient->description = $ingredientsRepository->getIngredientDescription($ingredient->id);
        echo"<pre>";
        var_dump($ingredient);
    }
}
