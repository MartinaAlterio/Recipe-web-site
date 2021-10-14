<?php

namespace App\Http\Controllers;

use App\Http\Classes\Database\Ingredients\IngredientsRepository;
use App\Http\Classes\Database\Recipes\RecipesRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RecipesController extends Controller
{

    /**
     * azione pagina macro
     *
     * @param  RecipesRepository  $recipesRepository
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getMacro(RecipesRepository $recipesRepository) {
        $macroPage = true;
        $macros = null;
        try {
            $macros = $recipesRepository->getListMacro();
            foreach ($macros as $macro) {
                $macro->categories = $recipesRepository->getCategoriesMacro($macro->id);
            }
        } catch (Exception $e) {
            $error = true;
            $this->addFlashMessage("Impossibile recuperare la lista delle categorie", "error");

            return $this->render('ricette.macro', compact('macros', 'error'));
        }
        return $this->render('ricette.macro', compact('macros', 'macroPage'));
    }

    /**
     * azione pagina categorie
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $url_category
     * @return Application|Factory|View
     */
    public function getCategory(RecipesRepository $recipesRepository, $url_category) {
        $category = null;
        try {
            $category = $recipesRepository->getCategoryFromUrl($url_category);
            $category->recipes = $recipesRepository->getCategoryRecipes($category->id);
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare le infromazioni sulla seguente categoria ($url_category)", "error");
            return $this->render('ricette.category', compact('category', 'url_category'));
        }
        return $this->render('ricette.category', compact('category'));
    }

    /**
     * azione pagina dettaglio ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $url_category
     * @param $url_recipe
     * @return Application|Factory|View
     */
    public function getRecipe(RecipesRepository $recipesRepository,IngredientsRepository $ingredientsRepository,$url_category, $url_recipe) {
        $recipe = null;
        try {
            // todo: devo valutare se questa soluzione mi piace.
            $recipe = $recipesRepository->getRecipeFromUrl($url_recipe);
            $recipe->category = $recipesRepository->getcategoryFromUrl($url_category);
            $recipe->ingredients = $ingredientsRepository->getRecipeIngredients($recipe->id);
            $recipe->methods = $recipesRepository->getRecipeMethods($recipe->id);
            $recipe->linked_recipes = $recipesRepository->getRecipesLinkedToRecipe($recipe->id);
            foreach ($recipe->linked_recipes as $linked_recipe) {
                $linked_recipe->linked_category_url = $recipesRepository->getCategoryFromRecipe($recipe->id)->url;
            }
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare il dettaglio della ricetta", "error");
        }
        return $this->render('ricette.detail', compact('recipe'));
    }

    /**
     * azione recupero ricette database
     *
     * @param  RecipesRepository  $recipesRepository
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getRecipesDatabase (RecipesRepository $recipesRepository) {
        $recipes = null;
        try {
            $recipes =$recipesRepository->getAllRecipes();
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare la lista ricetta", "error");
        }
        return $this->render('CRUD.recipes', compact('recipes'));
    }

    /**
     * azione inserimento/modifica/cancellazione ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  Request  $request
     * @return RedirectResponse|null
     */
     public function cudRecipe (RecipesRepository $recipesRepository, Request $request): ?RedirectResponse {
        try {
            switch ($request->request->get('action')) {
                case 'insert':
                    $recipesRepository->insertRecipe($request->request->get('name'), $request->request->get('url'), $request->request->get('subheading'), $request->request->get('image'), $request->request->get('active'));
                    $this->addFlashMessage("Ricetta inserita correttamente", "success");
                    break;
                case 'update':
                    $recipesRepository->updateRecipe($request->request->get('name'), $request->request->get('url'), $request->request->get('subheading'), $request->request->get('image'), $request->request->get('active'), $request->request->get('id'));
                    $this->addFlashMessage("Ricetta modificata correttamente", "success");
                    break;
                case 'delete' :
                    $recipesRepository->deleteRecipe($request->request->get('id'));
                    $this->addFlashMessage("Ricetta cancellata correttamente", "success");
                    break;
                default :
                    $this->addFlashMessage("Azione non valida.", "error");
            }
        } catch (Exception $e) {
            $this->addFlashMessage($e->getMessage(), "error");
        }
        return redirect()->route('databaseRecipe');

    }

    /**
     * azine recupero ingredienti ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $urlRecipe
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getRecipeIngredientsDatabase (RecipesRepository $recipesRepository, IngredientsRepository $ingredientsRepository, $urlRecipe) {
        $recipe = null;
        $ingredients = null;
        $recipe_ingredients = [];
        try {
            $recipe = $recipesRepository->getRecipeFromUrl($urlRecipe);
            $ingredients = $ingredientsRepository->getAllIngredients();
            $recipe_ingredients_list = $ingredientsRepository->getRecipeIngredients($recipe->id);
            foreach ($recipe_ingredients_list as $recipe_ingredient) {
                $recipe_ingredients[$recipe_ingredient->id] = [
                    "quantity"=> $recipe_ingredient->pivot->quantity
                ];
            }
        } catch (Exception $e) {
            $this->addFlashMessage("Non è possibile recuperare gli ingredienti associati alla ricetta ({{$urlRecipe}})", "error");
        }
        return $this->render('CRUD.recipe_ingredients', compact('recipe', 'ingredients', 'recipe_ingredients'));
    }

    /**
     * azione inserimento/modifica ingredienti ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function cuRecipeIngredients(RecipesRepository $recipesRepository, Request $request): RedirectResponse {
        $url = null;
        try {
            $recipe_ingredients = [];
            foreach ($request->request->get('ingredients', []) as  $ingredient) {
                if(isset($ingredient['checked']) && !empty($ingredient['quantity'])) {
                    $recipe_ingredients[] = [
                        "id_ingredient" => $ingredient['checked'],
                        "quantity" => $ingredient['quantity']
                    ];
                }
            }
            $recipesRepository->insertRecipeIngredients($request->request->get('id_recipe'), $recipe_ingredients);
            $url = $request->request->get('url');
            $this->addFlashMessage("Ingredienti inseriti con successo", "success");
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile inserire gli ingredienti selezionati", "error");
        }
        return redirect()->route('databaseRecipeIngredients', ['recipe'=>$url]);
    }

    /**
     * azione recupero metodi ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $urlRecipe
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getMethodsRecipeDatabase (RecipesRepository $recipesRepository, $urlRecipe) {
        $recipe = null;
        $methods = null;
        try {
            $recipe = $recipesRepository->getRecipeFromUrl($urlRecipe);
            $id_recipe = $recipe->id;
            $methods = $recipesRepository->getRecipeMethods($id_recipe);
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare i procediementi della ricetta $urlRecipe", "error");
        }
        return $this->render('CRUD.recipe_methods', compact('methods', 'recipe'));
    }

    /**
     *
     *
     * azione inserimento/modifica/cancellazione metodo ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  Request  $request
     * @return RedirectResponse|null
     * @throws Exception
     */
    public function cudRecipeMethod(RecipesRepository $recipesRepository, Request $request): ?RedirectResponse {
        $url = $request->request->get('url');
        try {
            switch ($request->request->get('action')) {
                case 'insert':
                    $recipesRepository->insertMethod($request->request->get('method'), $request->request->get('image'), $request->request->get('id_recipe'));
                    $this->addFlashMessage("Procedimento inserito con successo.","success");
                    break;
                case 'update':
                    $recipesRepository->updateMethod($request->request->get('method'), $request->request->get('image'), $request->request->get('id'));
                    $this->addFlashMessage("Procedimento modificato con successo.","success");
                    break;
                case 'delete' :
                    $recipesRepository->deleteMethod($request->request->get('id'));
                    $this->addFlashMessage("Procedimento cancellato con successo.","success");
                    break;
                default :
                    $this->addFlashMessage("Azione non valida.", "error");
            }
        } catch (Exception $e) {
            $this->addFlashMessage($e->getMessage(), "error");
        }
        return redirect()->route('databaseRecipeMethods', ['recipe'=>$url]);
    }

    /**
     * azione recupero ricette associate
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $url_recipe
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getLinkedRecipesDatabase (RecipesRepository $recipesRepository, $url_recipe) {
        $main_recipe = null;
        $recipes = null;
        $linked_recipes_id = [];
        try {
            $main_recipe = $recipesRepository->getRecipeFromUrl($url_recipe);
            $linked_recipes= $recipesRepository->getLinkedRecipes($main_recipe->id);
            $recipes = $recipesRepository->getAllRecipes();
            foreach ($linked_recipes as $linked_recipe) {
                $linked_recipes_id[] = $linked_recipe->id;
            }
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare l'elenco delle ricette.", "error");
        }
        return $this->render('CRUD.recipes_linked', compact('main_recipe', 'recipes', 'linked_recipes_id'));
    }

    /**
     * azione inserimento e modifica ricetta associata
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function cuRecipeLinked (RecipesRepository $recipesRepository, Request $request): RedirectResponse {
        $url = null;
        try {
            $recipesRepository->insertLinkedRecipes($request->request->get('id_recipe'), $request->request->get('id'));
            $url = $request->request->get('url');
            $this->addFlashMessage("Collegamenti aggiunti con successo", "success");
        } catch (Exception $e) {
            $this->addFlashMessage("impossibile aggiungere i collegamenti", "error");
        }
        return redirect()->route('databaseRecipeslinked', ['recipe'=>$url]);
    }

    /**
     * azione recupero categorie
     *
     * @param  RecipesRepository  $recipesRepository
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getCategoriesDatabase (RecipesRepository $recipesRepository) {
        $categories = [];
        try {
            $categories = $recipesRepository->getCategories();
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare le categorie.", "success");
        }
        return $this->render('CRUD.categories', compact('categories'));
    }

    /**
     * azione inserimento modifica e cancellazione categorie
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  Request  $request
     * @return RedirectResponse|null
     * @throws Exception
     */
    public function cudCategories (RecipesRepository $recipesRepository, Request $request): ?RedirectResponse {
        try {
            switch ($request->request->get('action')) {
                case 'insert':
                    $recipesRepository->insertCategory($request->request->get('name'), $request->request->get('url'), $request->request->get('macro'), $request->request->get('image'), $request->request->get('description'));
                    $this->addFlashMessage("Categoria inserita con successo.", "success");
                    break;
                case 'update':
                    $recipesRepository->updateCategory($request->request->get('name'), $request->request->get('url'), $request->request->get('macro'), $request->request->get('image'), $request->request->get('description'), $request->request->get('id'));
                    $this->addFlashMessage("Categoria modificata con successo.", "success");
                    break;
                case 'delete':
                    $recipesRepository->deleteCategory($request->request->get('id'));
                    $this->addFlashMessage("Categoria cancellata con successo.", "success");
                    break;
                default :
                    $this->addFlashMessage("Azione non valida.", "error");
            }
        } catch (Exception $e) {
            $this->addFlashMessage($e->getMessage(), "error");
        }
        return redirect()->route('databaseCategories');
    }

    /**
     * azione recupero ricette associate a categoria
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $url_category
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getCategoryRecipesDatabase(RecipesRepository $recipesRepository, $url_category) {
        $category = null;
        $recipes = null;
        $id_recipes = [];
        try {
            $category = $recipesRepository->getCategoryFromUrl($url_category);
            $recipes = $recipesRepository->getAllRecipes();
            $recipes_category = $recipesRepository->getCategoryRecipes($category->id);
            foreach ($recipes_category as $recipe_category) {
                $id_recipes[] = $recipe_category->id;
            }
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperale la lista delle ricette associate a ($url_category)", "error");
        }
        return $this->render('CRUD.categories_recipes', compact('category', 'recipes', 'id_recipes'));
    }

    /**
     * azione inserimento/modifica ricette associate a categorie
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function cuCategoryRecipes(RecipesRepository $recipesRepository, Request $request): RedirectResponse {
        $url = null;
        try {
            $recipesRepository->insertCategoryRecipes($request->request->get('id_category'), $request->request->get('id'));
            $url = $request->request->get('url');
            $this->addFlashMessage("Ricette associate modificate con successo.", "success");
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile modificare le ricette associate.", "error");
        }
        return redirect()->route('databaseCategoriesRecipes', ['category'=>$url]);
    }

    /**
     * azione recupero categorie associate a macro
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $url_category
     * @return Application|Factory|View
     * @throws Exception
     */
    public function getCategoriesLinkedDatabase(RecipesRepository $recipesRepository, $url_category) {
        $macro = null;
        $categories = [];
        $id_categories = [];
        try {
            $macro = $recipesRepository->getCategoryFromUrl($url_category);
            $categories = $recipesRepository->getCategories();
            $categories_macro = $recipesRepository->getCategoriesMacro($macro->id);
            foreach ($categories_macro as $category_macro) {
                $id_categories[] = $category_macro->id;
            }
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile recuperare le categorie associate alla macro $url_category)", "error");
        }
        return $this->render('CRUD.categories_macro', compact('macro', 'categories', 'id_categories'));
    }

    /**
     * azione inserimento/modifica categorie associate a macro
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function cuCategoriesLinked(RecipesRepository $recipesRepository, Request $request): RedirectResponse {
        $url = null;
        try {
            $recipesRepository->insertMacroCategories($request->request->get('id_macro'), $request->request->get('id'));
            $url = $request->request->get('url');
            $this->addFlashMessage("Categorie associate modificate con successo.", "success");
        } catch (Exception $e) {
            $this->addFlashMessage("Impossibile aggiungere i collegamenti.", "error");
        }
        return redirect()->route('databaseCategoriesLinked', ['category'=>$url]);
    }
}
