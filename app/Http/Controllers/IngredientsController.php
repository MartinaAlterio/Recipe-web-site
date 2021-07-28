<?php

namespace App\Http\Controllers;

use App\Http\Classes\Database\Texts\HomeTextRepository;
use App\Http\Classes\Database\Ingredients\IngredientsRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Exceptions\MyExceptions;

class IngredientsController extends Controller
{

    /**
     *azioni pagina ingredienti
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param  HomeTextRepository  $homeTextRepository
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getIngredients(IngredientsRepository $ingredientsRepository,HomeTextRepository $homeTextRepository){
        try {
            $list = $ingredientsRepository->getActiveIngredients();
            $ingredients = new \stdClass();
            $ingredients->upTitle = $homeTextRepository->getContent('upTitle','ingredients');
            $ingredients->underTitle = $homeTextRepository->getContent('underTitle','ingredients');
            $ingredients->description = $homeTextRepository->getContent('description', 'ingredients');
            $ingredients->title = $homeTextRepository->getContent('title', 'ingredients');
            return $this->render('ingredienti.list', compact('list', 'ingredients'));
        } catch(Exception $e) {
            $this->addFlashMessage('Impossibile recuperare la lista degli ingredienti', 'error');
            return $this->render('ingredienti.list', compact('list', 'ingredients'));
        }

    }

    /**
     * azioni pagina dettaglio ingrediente
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $url
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getDetailIngredient(IngredientsRepository $ingredientsRepository, $url) {
        try {
            $ingredient = $ingredientsRepository->getIngredientFromUrl($url);
            if ($ingredient !== null) {
                $ingredient->description = $ingredientsRepository->getIngredientDescription($url);
                return $this->render('ingredienti.detail', compact('ingredient'));
            } else {
                $inactive = true;
                throw new MyExceptions("Ingrediente non attivo");
            }
        } catch (MyExceptions $e) {
            $this->addFlashMessage("L'ingrediente cercato non è al momento attivo", 'error');
            return $this->render('ingredienti.detail', compact('inactive'));
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare l'ingrediente selezionato", 'error');
            return $this->render('ingredienti.detail', compact('ingredient'));
        }
    }

    /**
     * azione  recupero ingredienti
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getListIngredient (IngredientsRepository $ingredientsRepository) {
        try {
            $ingredients = $ingredientsRepository->getAllIngredients();
            return $this->render('CRUD.ingredient', compact('ingredients'));
        } catch (Exception $e) {
            $this->addFlashMessage("Non è possibile recuperare l'elenco degli ingredienti", 'error');
            return $this->render('CRUD.ingredient', compact('ingredients'));
        }
    }

    /**
     *azione inserimento ingredienti
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @return RedirectResponse
     * @throws Exception
     */
    public function cudIngredient (IngredientsRepository $ingredientsRepository): RedirectResponse {
        try {
            if(isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'insert':
                        $ingredientsRepository->insertIngredient($_POST['name'], $_POST['url'], $_POST['active']);
                        throw new MyExceptions("Ingrediente inserito con successo");
                    case 'update':
                        $ingredientsRepository->updateIngredient($_POST['name'], $_POST['url'], $_POST['active'], $_POST['id']);
                        throw new MyExceptions("Ingrediente modificato con successo");
                    case 'delete' :
                        $ingredientsRepository->deleteIngredient($_POST['id']);
                        throw new MyExceptions("Ingrediente cancellato con successo");
                }
                return redirect()->route('databaseIngredients');
            }
        } catch (MyExceptions $e) {
            $this->addFlashMessage($e->getMessage(), 'success');
            return redirect()->route('databaseIngredients');
        } catch (Exception $e) {
            $this->addFlashMessage($e->getMessage(), 'error');
            return redirect()->route('databaseIngredients');
        }
    }

    /**
     * azione recupero descrizione ingredienti attivi
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $url
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getDescription(IngredientsRepository $ingredientsRepository, $url) {
        try {
            $descriptions = $ingredientsRepository->getIngredientDescription($url);
            return $this->render('CRUD.ingredient_description', compact(['descriptions', 'url']));
        } catch (Exception $e) {
            $this->addFlashMessage("Non è possibile recuperale l'eleneco delle descrizioni", "error");
            return $this->render('CRUD.ingredient_description', compact(['descriptions', 'url']));
        }
    }

    /**
     * azione inserimento/modifica/cancellazione descrizione ingredeiente attivo
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $url
     * @return RedirectResponse
     * @throws Exception
     */
    public function cudIngredientDescription(IngredientsRepository $ingredientsRepository, $url): RedirectResponse {
        try {
            if(isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'insert':
                        $ingredientsRepository->insertIngredientDescription($url, $_POST['description'], $_POST['image']);
                        throw new MyExceptions("Descrizione ingrediente inserito con successo");
                    case 'update':
                        $ingredientsRepository->updateIngredientDescription($_POST['description'], $_POST['image'], $url, $_POST['id']);
                        Throw new MyExceptions("Descrizione ingrediente modificato con successo");
                    case 'delete' :
                        $ingredientsRepository->deleteIngredientDescription($_POST['id']);
                        Throw new MyExceptions("Descrizione ingrediente modificato con successo");
                }
                return redirect()->route('databaseDescription', ['url' => $url]);
            }
        } catch (MyExceptions $e) {
            $this->addFlashMessage($e->getMessage(), 'success');
            return redirect()->route('databaseDescription', ['url' => $url]);
        } catch (Exception $e) {
            $this->addFlashMessage($e->getMessage(), 'error');
            return redirect()->route('databaseDescription', ['url' => $url]);
        }
    }
}
