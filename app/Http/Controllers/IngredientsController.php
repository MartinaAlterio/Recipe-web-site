<?php

namespace App\Http\Controllers;

use App\Http\Classes\Database\Texts\HomeTextRepository;
use App\Http\Classes\Database\Ingredients\IngredientsRepository;
use App\Models\IngredientsContent;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Exceptions\MyExceptions;
use Illuminate\Http\Request;

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
        $list = [];
        $ingredients = new IngredientsContent();
        try {
            $list = $ingredientsRepository->getActiveIngredients();
            $ingredients->setUpTitle($homeTextRepository->getContent('upTitle','ingredients'));
            $ingredients->setUnderTitle($homeTextRepository->getContent('underTitle','ingredients'));
            $ingredients->setDescription($homeTextRepository->getContent('description', 'ingredients'));
            $ingredients->setTitle($homeTextRepository->getContent('title', 'ingredients'));
        } catch(Exception $e) {
            $this->addFlashMessage('Impossibile recuperare la lista degli ingredienti', 'error');
        }
        return $this->render('ingredienti.list', compact('list', 'ingredients'));
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
        $ingredient = null;
        try {
            $ingredient = $ingredientsRepository->getIngredientFromUrl($url);
            if (!empty($ingredient)) {
                $ingredient->description = $ingredientsRepository->getIngredientDescription($url);
            } else {
                $inactive = true;
                $this->addFlashMessage("Ingrediente non attivo.", "error");
                return $this->render('ingredienti.detail', compact('inactive'));
            }
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare l'ingrediente selezionato.", 'error');
        }
        return $this->render('ingredienti.detail', compact('ingredient'));
    }

    /**
     * azione  recupero ingredienti
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getListIngredient (IngredientsRepository $ingredientsRepository) {
        $ingredients = null;
        try {
            $ingredients = $ingredientsRepository->getAllIngredients();
        } catch (Exception $e) {
            $this->addFlashMessage("Non è possibile recuperare l'elenco degli ingredienti.", 'error');
        }
        return $this->render('CRUD.ingredient', compact('ingredients'));
    }

    /**
     *azione inserimento ingredienti
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function cudIngredient (IngredientsRepository $ingredientsRepository, Request $request): ?RedirectResponse {
        try {
            switch ($request->request->get('action')) {
                case 'insert':
                    $ingredientsRepository->insertIngredient($request->request->get('name'), $request->request->get('url'), $request->request->get('active'));
                    $this->addFlashMessage("Ingrediente inserito con successo.", "successo");
                    break;
                case 'update':
                    $ingredientsRepository->updateIngredient($request->request->get('name'), $request->request->get('url'), $request->request->get('active'), $request->request->get('id'));
                    $this->addFlashMessage("Ingrediente modificato con successo.", "successo");
                    break;
                case 'delete' :
                    $ingredientsRepository->deleteIngredient($request->request->get('id'));
                    $this->addFlashMessage("Ingrediente cancellato con successo.", "successo");
                    break;
                default :
                    $this->addFlashMessage("Azione non valida.", "error");
            }
        } catch (Exception $e) {
            $this->addFlashMessage($e->getMessage(), 'error');
        }
        return redirect()->route('databaseIngredients');
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
        $descriptions = null;
        try {
            $descriptions = $ingredientsRepository->getIngredientDescription($url);
        } catch (Exception $e) {
            $this->addFlashMessage("Non è possibile recuperale l'eleneco delle descrizioni", "error");
        }
        return $this->render('CRUD.ingredient_description', compact(['descriptions', 'url']));
    }

    /**
     * azione inserimento/modifica/cancellazione descrizione ingredeiente attivo
     *
     * @param  IngredientsRepository  $ingredientsRepository
     * @param  Request  $request
     * @param $url
     * @return RedirectResponse
     */
    public function cudIngredientDescription(IngredientsRepository $ingredientsRepository, Request $request, $url): RedirectResponse {
        try {
            switch ($request->request->get('action')) {
                case 'insert':
                    $ingredientsRepository->insertIngredientDescription($url, $request->request->get('description'), $request->request->get('image'));
                    $this->addFlashMessage("Descrizione ingrediente inserita con successo.", "successo");
                    break;
                case 'update':
                    $ingredientsRepository->updateIngredientDescription($request->request->get('description'), $request->request->get('image'), $url, $request->request->get('id'));
                    $this->addFlashMessage("Descrizione ingrediente modificata con successo.", "successo");
                    break;
                case 'delete' :
                    $ingredientsRepository->deleteIngredientDescription($request->request->get('id'));
                    $this->addFlashMessage("Descrizione ingrediente cancellata con successo.", "successo");
                    break;
                default :
                    $this->addFlashMessage("Azione non valida.", "error");
            }
        } catch (Exception $e) {
            $this->addFlashMessage($e->getMessage(), 'error');
        }
        return redirect()->route('databaseDescription', ['url' => $url]);
    }
}
