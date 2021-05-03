<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Http\classes\database\ingredients\IngredientiRepository;
use App\Http\classes\database\Recipes\RicetteRepository;
use Illuminate\Support\Facades\DB;

class RicetteController extends Controller
{

    public function test(RicetteRepository $ricetteRepository) {
            $macros = $ricetteRepository->getListMacro();
            foreach ($macros as $macro) {
                $macro->categories = $ricetteRepository->getCategoriesMacro($macro->id);
                foreach ($macro->categories as $category) {
                    $category->recipes = $ricetteRepository->getImportantRecipesCategory($category->id);
                }
            }

        echo "<pre>";
        var_dump($macros);
    }

}
