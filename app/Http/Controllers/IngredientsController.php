<?php

namespace App\Http\Controllers;

use App\Http\classes\database\texts\HomeTextRepository;
use App\Http\classes\database\ingredients\IngredientsRepository;
use Exception;

class IngredientsController extends Controller
{

    /**
     *azioni pagina ingredienti
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param  HomeTextRepository  $homeTextRepository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getIngredients(IngredientsRepository $ingredientsRepository,HomeTextRepository $homeTextRepository){
        $list = $ingredientsRepository->getActiveIngredients();
        $ingredients = new \stdClass();
        $ingredients->upTitle = $homeTextRepository->getContent('upTitle','ingredients');
        $ingredients->underTitle = $homeTextRepository->getContent('underTitle','ingredients');
        $ingredients->description = $homeTextRepository->getContent('description', 'ingredients');
        $ingredients->title = $homeTextRepository->getContent('title', 'ingredients');
        return $this->render('ingredienti.list', compact('list', 'ingredients'));
    }

    /**
     * azioni pagina dettaglio ingrediente
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getDetailIngredient(IngredientsRepository $ingredientsRepository, $url) {
        $ingredient = $ingredientsRepository->getIngredientFromUrl($url);
        if ($ingredient !== null) {
            $ingredient->description = $ingredientsRepository->getIngredientDescription($url);
            return $this->render('ingredienti.detail', compact('ingredient'));
        } else {
            $inactive = true;
            return $this->render('ingredienti.detail', compact ('inactive'));
        }
    }

    /**
     * azione  recupero ingredienti
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws Exception
     */
    public function getListIngredient (IngredientsRepository $ingredientsRepository) {
        $ingredients = $ingredientsRepository->getAllIngredients();
        return $this->render('CRUD.ingredient', compact('ingredients'));
    }

    /**
     *azione inserimento ingredienti
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * azione recupero descrizione ingredienti attivi
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getDescription(IngredientsRepository $ingredientsRepository, $url) {
        $descriptions = $ingredientsRepository->getIngredientDescription($url);
        return $this->render('CRUD.ingredient_description', compact(['descriptions', 'url']));
    }

    /**
     * azione inserimento/modifica/cancellazione descrizione ingredeiente attivo
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $url
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cudIngredeintDescription(IngredientsRepository $ingredientsRepository, $url) {
        if(isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'insert':
                    $ingredientsRepository->cudIngredeintDescription($url, $_POST['description'], $_POST['image']);
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
