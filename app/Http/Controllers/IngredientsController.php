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
        if ($ingredient !== null) {
            $ingredient->description = $ingredientsRepository->getIngredientDescription($url);
            echo"<pre>";
            var_dump($ingredient);
        } else {die('Ingredient inactive');}

    }

    public function getListIngredient (IngredientsRepository $ingredientsRepository) {
        $ingredients = $ingredientsRepository->getAllIngredients();
        return view('CRUD.crud', compact('ingredients'));
    }

    public function insertIngredient (IngredientsRepository $ingredientsRepository) {
        if(isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'insert':
                    $ingredientsRepository->insertIngredient($_POST['name'], $_POST['url'], $_POST['active']);
                    break;
                case 'update':
                    $ingredientsRepository->updateIngredient($_POST['name'], $_POST['url'], $_POST['active'], $_POST['id']);
                    break;
                case 'delete' :
                    $ingredientsRepository->deleteIngredient($_POST['id']);
                    break;
            }
            return redirect()->route('databaseIngredients');
        }
    }

    public function getDescription(IngredientsRepository $ingredientsRepository, $url) {
        $descriptions = $ingredientsRepository->getIngredientDescription($url);
        return view('CRUD.ingredient_description', compact(['descriptions', 'url']));
    }

    public function insertIngredientDescription(IngredientsRepository $ingredientsRepository, $url) {
        if(isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'insert':
                    $ingredientsRepository->insertIngredientDescription($url, $_POST['description']);
                    break;
                case 'update':
                    $ingredientsRepository->updateIngredientDescription($_POST['description'], $url, $_POST['id']);
                    break;
                case 'delete' :
                    $ingredientsRepository->deleteIngredientDescription($_POST['id']);
                    break;
            }
            return redirect()->route('databaseDescription', ['url'=>$url]);
        }
    }
}
