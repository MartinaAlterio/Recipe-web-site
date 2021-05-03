<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Http\classes\database\ingredients\IngredientiRepository;
use App\Http\classes\database\Recipes\RicetteRepository;
use Illuminate\Support\Facades\DB;

class IngredientiController extends Controller
{
    public function test1(IngredientiRepository $ingredientiRepository) {
        $ingredient = $ingredientiRepository->getRecipe(2);
        echo "<pre>";
        var_dump($ingredient);
    }
}
