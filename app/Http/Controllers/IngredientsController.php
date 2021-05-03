<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Http\classes\database\ingredients\IngredientsRepository;
use App\Http\classes\database\Recipes\RecipesRepository;
use Illuminate\Support\Facades\DB;

class IngredientsController extends Controller
{
    public function test1(IngredientsRepository $ingredientsRepository) {
        $ingredient = $ingredientsRepository->getRecipe(2);
        echo "<pre>";
        var_dump($ingredient);
    }
}
