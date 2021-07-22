<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Http\classes\database\ingredients\IngredientsRepository;
use App\Http\classes\database\Recipes\RecipesRepository;
use Illuminate\Support\Facades\DB;

class RecipesController extends Controller
{

    /**
     * azione pagina macro
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getMacro(RecipesRepository $recipesRepository) {
        $macros = $recipesRepository->getListMacro();
        foreach ($macros as $macro) {
            $macro->categories = $recipesRepository->getCategoriesMacro($macro->id);
        }

        return $this->render('ricette.macro', compact('macros'));
    }

    /**
     * azione pagina categorie
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getCategory(RecipesRepository $recipesRepository, $category) {
        $category = $recipesRepository->getCategoryFromUrl($category);
        $category->recipes = $recipesRepository->getCategoryRecipes($category->id);
        return $this->render('ricette.category', compact('category'));
    }

    /**
     * azione pagina dettaglio ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $category
     * @param $recipe
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getRecipe(RecipesRepository $recipesRepository,IngredientsRepository $ingredientsRepository,$category, $recipe) {
        $recipe = $recipesRepository->getRecipeFromUrl($recipe);
        $recipe->category = $recipesRepository->getcategoryFromUrl($category);
        $recipe->ingredients = $ingredientsRepository->getRecipeIngredients($recipe->id);
        $recipe->methods = $recipesRepository->getRecipeMethods($recipe->id);
        return $this->render('ricette.detail', compact('recipe'));
    }

    /**
     * azione recupero ricette database
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getRecipesDatabase (RecipesRepository $recipesRepository) {
        $recipes =$recipesRepository->getAllRecipes();
        return $this->render('CRUD.recipes', compact('recipes'));
    }

    /**
     * azione inserimento/modifica/cancellazione ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function cudIRecipe (RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'insert':
                    $recipesRepository->insertRecipe($_POST['name'], $_POST['url'], $_POST['subheading'], $_POST['image'], $_POST['active']);
                    break;
                case 'update':
                    $recipesRepository->updateRecipe($_POST['name'], $_POST['url'], $_POST['subheading'], $_POST['image'], $_POST['active'], $_POST['id']);
                    break;
                case 'delete' :
                    $recipesRepository->deleteRecipe($_POST['id']);
                    break;
            }
            return redirect()->route('databaseRecipe');
        }
        return null;
    }

    /**
     * azine recupero ingredienti ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param  IngredientsRepository  $ingredientsRepository
     * @param $urlRecipe
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getRecipeIngredientsDatabase (RecipesRepository $recipesRepository, IngredientsRepository $ingredientsRepository, $urlRecipe) {
        $recipe = $recipesRepository->getRecipeFromUrl($urlRecipe);
        $ingredients = $ingredientsRepository->getAllIngredients();
        $recipe_ingredients = $ingredientsRepository->getRecipeIngredients($recipe->id);
        $id_ingredients = [];
        foreach ($recipe_ingredients as $recipe_ingredient) {
            $id_ingredients[] = $recipe_ingredient->id;
        }
        return $this->render('CRUD.recipe_ingredients', compact('recipe', 'ingredients', 'id_ingredients'));
    }

    /**
     * azione inserimento/modifica ingredienti ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cuRecipeIngredients(RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            $recipesRepository->insertRecipeIngredients($_POST['id_recipe'], $_POST['id']);
            $url = $_POST['url'];
        }
        return redirect()->route('databaseRecipeIngredients', ['recipe'=>$url]);
    }

    /**
     * azione recupero metodi ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $urlRecipe
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getMethodsRecipeDatabase (RecipesRepository $recipesRepository, $urlRecipe) {
        $recipe = $recipesRepository->getRecipeFromUrl($urlRecipe);
        $id_recipe = $recipe->id;
        $methods = $recipesRepository->getRecipeMethods($id_recipe);
        return $this->render('CRUD.recipe_methods', compact('methods', 'recipe'));
    }

    /**
     *
     *
     * azione inserimento/modifica/cancellazione metodo ricetta
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function cudRecipeMethod(RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'insert':
                    $recipesRepository->insertMethod($_POST['method'], $_POST['image'], $_POST['id_recipe']);
                    break;
                case 'update':
                    $recipesRepository->updateMethod($_POST['method'], $_POST['image'], $_POST['id']);
                    break;
                case 'delete' :
                    $recipesRepository->deleteMethod($_POST['id']);
                    break;
            }
            $url = $_POST['url'];
            return redirect()->route('databaseRecipeMethods', ['recipe'=>$url]);
        }
        return null;
    }

    /**
     * azione recupero ricette associate
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $url_recipe
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getLinkedRecipesDatabase (RecipesRepository $recipesRepository, $url_recipe) {
        $main_recipe = $recipesRepository->getRecipeFromUrl($url_recipe);
        $linked_recipes= $recipesRepository->getLinkedRecipes($main_recipe->id);
        $recipes = $recipesRepository->getAllRecipes();
        $linked_recipes_id = [];
        foreach ($linked_recipes as $linked_recipe) {
            $linked_recipes_id[] = $linked_recipe->id_linked_recipe;
        }
        return $this->render('CRUD.recipes_linked', compact('main_recipe', 'recipes', 'linked_recipes_id'));
    }

    /**
     * azione inserimento e modifica ricetta associata
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cuRecipeLinked (RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            $recipesRepository->insertLinkedRecipes($_POST['id_recipe'], $_POST['id']);
            $url = $_POST['url'];
        }
        return redirect()->route('databaseRecipeslinked', ['recipe'=>$url]);
    }

    /**
     * azione recupero categorie
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getCategoriesDatabase (RecipesRepository $recipesRepository) {
        $categories = $recipesRepository->getCategories();
        return $this->render('CRUD.categories', compact('categories'));
    }

    /**
     * a<ionw
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function cudCategories (RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'insert':
                    $recipesRepository->insertCategory($_POST['name'], $_POST['url'], $_POST['macro'], $_POST['image'], $_POST['description']);
                    break;
                case 'update':
                    $recipesRepository->updateCategory($_POST['name'], $_POST['url'], $_POST['macro'], $_POST['image'], $_POST['description'], $_POST['id']);
                    break;
                case 'delete' :
                    $recipesRepository->deleteCategory($_POST['id']);
                    break;
            }
            return redirect()->route('databaseCategories');
        }
        return null;
    }

    /**
     * azione recupero ricette associate a categoria
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $url_category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getCategoryRecipesDatabase(RecipesRepository $recipesRepository, $url_category) {
        $category = $recipesRepository->getCategoryFromUrl($url_category);
        $recipes = $recipesRepository->getAllRecipes();
        $recipes_category = $recipesRepository->getCategoryRecipes($category->id);
        $id_recipes = [];
        foreach ($recipes_category as $recipe_category) {
            $id_recipes[] = $recipe_category->id;
        }
        return $this->render('CRUD.categories_recipes', compact('category', 'recipes', 'id_recipes'));
    }

    /**
     * azione inserimento/modifica ricette associate a categorie
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cuCategoryRecipes(RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            $recipesRepository->insertCategoryRecipes($_POST['id_category'], $_POST['id']);
            $url = $_POST['url'];
        }
        return redirect()->route('databaseCategoriesRecipes', ['category'=>$url]);
    }

    /**
     * azione recupero categorie associate a macro
     *
     * @param  RecipesRepository  $recipesRepository
     * @param $url_category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getCategoriesLinkedDatabase(RecipesRepository $recipesRepository, $url_category) {
        $macro = $recipesRepository->getCategoryFromUrl($url_category);
        $categories = $recipesRepository->getCategories();
        $categories_macro = $recipesRepository->getCategoriesMacro($macro->id);
        $id_categories = [];
        foreach ($categories_macro as $category_macro) {
            $id_categories[] = $category_macro->id;
        }
        return $this->render('CRUD.categories_macro', compact('macro', 'categories', 'id_categories'));
    }

    /**
     * azione inserimento/modifica categorie associate a macro
     *
     * @param  RecipesRepository  $recipesRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cuCategoriesLinked(RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            $recipesRepository->insertMacroCategories($_POST['id_macro'], $_POST['id']);
            $url = $_POST['url'];
        }
        return redirect()->route('databaseCategoriesLinked', ['category'=>$url]);
    }
}
