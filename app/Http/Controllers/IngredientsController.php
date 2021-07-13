<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;

use App\Http\classes\database\texts\HomeTextRepository;
use App\Http\classes\database\ingredients\IngredientsRepository;
use App\Http\classes\database\Recipes\RecipesRepository;
use Illuminate\Support\Facades\DB;

class IngredientsController extends Controller
{
    public function getIngredients(IngredientsRepository $ingredientsRepository,HomeTextRepository $homeTextRepository){
        $list = $ingredientsRepository->getActiveIngredients();
        $ingredients = new \stdClass();
        $ingredients->upTitle = $homeTextRepository->getContent('upTitle','ingredients');
        $ingredients->underTitle = $homeTextRepository->getContent('underTitle','ingredients');
        $ingredients->description = $homeTextRepository->getContent('description', 'ingredients');
        $ingredients->title = $homeTextRepository->getContent('title', 'ingredients');
        return view('ingredienti.list', compact('list', 'ingredients'));
    }

    public function getDetailIngredient(IngredientsRepository $ingredientsRepository, $url) {
        $ingredient = $ingredientsRepository->getIngedientFromUrl($url);
        if ($ingredient !== null) {
            $ingredient->description = $ingredientsRepository->getIngredientDescription($url);
            return view('ingredienti.detail', compact('ingredient'));
        } else {
            $inactive = true;
            return view('ingredienti.detail', compact ('inactive'));
        }
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
                    $ingredientsRepository->insertIngredientDescription($url, $_POST['description'], $_POST['image']);
                    break;
                case 'update':
                    $ingredientsRepository->updateIngredientDescription($_POST['description'],$_POST['image'], $url, $_POST['id']);
                    break;
                case 'delete' :
                    $ingredientsRepository->deleteIngredientDescription($_POST['id']);
                    break;
            }
            return redirect()->route('databaseDescription', ['url'=>$url]);
        }
    }
}
