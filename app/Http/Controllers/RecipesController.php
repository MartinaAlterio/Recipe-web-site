<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Http\classes\database\ingredients\IngredientsRepository;
use App\Http\classes\database\Recipes\RecipesRepository;
use Illuminate\Support\Facades\DB;

class RecipesController extends Controller
{

    public function getMacro(RecipesRepository $recipesRepository) {
        $macros = $recipesRepository->getListMacro();
        foreach ($macros as $macro) {
            $macro->image = $recipesRepository->getImageMacro($macro->id);
            $macro->categories = $recipesRepository->getCategoriesMacro($macro->id);
            foreach ($macro->categories as $category) {
                $category->recipes = $recipesRepository->getImportantRecipesCategory($category->id);
            }
        }
        return view('ricette.macro', compact('macros'));
    }

    public function getCategory(RecipesRepository $recipesRepository, $category) {
        $category = $recipesRepository->getCategoryFromUrl($category);
        $category->recipes = $recipesRepository->getRecipesCategory($category->id);
        return view('ricette.category', compact('category'));
    }

    public function getRecipe(RecipesRepository $recipesRepository,IngredientsRepository $ingredientsRepository,$category, $recipe) {
        $recipe = $recipesRepository->getRecipeFromUrl($recipe);
        $recipe->category = $recipesRepository->getcategoryFromUrl($category);
        $recipe->ingredients = $ingredientsRepository->getIngredientsRecipe($recipe->id);
        $recipe->methods = $recipesRepository->getRecipeMethods($recipe->id);
        return view('ricette.detail', compact('recipe'));
    }


    //metodi per l'interazione con il database

    public function getRecipesDatabase (RecipesRepository $recipesRepository) {
        $recipes =$recipesRepository->getAllRecipes();
        return view('CRUD.recipes', compact('recipes'));
    }

    public function CRUDrecipe (RecipesRepository $recipesRepository) {
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
    }

    public function getIngredientsRecipeDatabase (RecipesRepository $recipesRepository, IngredientsRepository $ingredientsRepository, $urlRecipe) {
        $recipe = $recipesRepository->getRecipeFromUrl($urlRecipe);
        $ingredients = $ingredientsRepository->getAllIngredients();
        $recipe_ingredients = $ingredientsRepository->getIngredientsRecipe($recipe->id);
        $id_ingredients = [];
        foreach ($recipe_ingredients as $recipe_ingredient) {
            $id_ingredients[] = $recipe_ingredient->id;
        }
        return view('CRUD.recipe_ingredients', compact('recipe', 'ingredients', 'id_ingredients'));
    }

    public function CRUDrecipeIngredients(RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            $recipesRepository->insertRecipeIngredients($_POST['id_recipe'], $_POST['id']);
            $url = $_POST['url'];
        }
        return redirect()->route('databaseRecipeIngredients', ['recipe'=>$url]);
    }


    public function getMethodsRecipeDatabase (RecipesRepository $recipesRepository, $urlRecipe) {
        $recipe = $recipesRepository->getRecipeFromUrl($urlRecipe);
        $id_recipe = $recipe->id;
        $methods = $recipesRepository->getRecipeMethods($id_recipe);
        return view('CRUD.recipe_methods', compact('methods', 'recipe'));
    }

    public function CRUDrecipeMethods(RecipesRepository $recipesRepository) {
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
    }

    public function getLinkedRecipesDatabase (RecipesRepository $recipesRepository, $url_recipe) {
        $main_recipe = $recipesRepository->getRecipeFromUrl($url_recipe);
        $linked_recipes= $recipesRepository->getLinkedRecipes($main_recipe->id);
        $recipes = $recipesRepository->getAllRecipes();
        $linked_recipes_id = [];
        foreach ($linked_recipes as $linked_recipe) {
            $linked_recipes_id[] = $linked_recipe->id_linked_recipe;
        }
        return view('CRUD.recipes_linked', compact('main_recipe', 'recipes', 'linked_recipes_id'));
    }

    public function CRUDlinkedRecipes (RecipesRepository $recipesRepository) {
        if(isset($_POST['action'])) {
            $recipesRepository->insertLinkedRecipes($_POST['id_recipe'], $_POST['id']);
            $url = $_POST['url'];
        }
        return redirect()->route('databaseRecipeslinked', ['recipe'=>$url]);
    }

    public function getCategoriesDatabase (RecipesRepository $recipesRepository) {
        $categories = $recipesRepository->getCategories();
        return view('CRUD.categories', compact('categories'));
    }

    public function CRUDcategories (RecipesRepository $recipesRepository) {
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
    }

    public function getCategoriesRecipesDatabase(RecipesRepository $recipesRepository, $url_category) {
        $category = $recipesRepository->getCategoryFromUrl($url_category);
        $recipes = $recipesRepository->getAllRecipes();
        $recipes_category = $recipesRepository->getRecipesCategory($category->id);
        $id_recipes = [];
        foreach ($recipes_category as $recipe_category) {
            $id_recipes[] = $recipe_category->id;
        }
        return view('CRUD.categories_recipes', compact('category', 'recipes', 'id_recipes'));
    }

    public function CRUDcategoriesRecipes(RecipesRepository $recipesRepository) {

    }

    public function getCategoriesLinkedDatabase(RecipesRepository $recipesRepository, $url) {

    }

    public function CRUDcategoriesLinked(RecipesRepository $recipesRepository) {

    }
}
