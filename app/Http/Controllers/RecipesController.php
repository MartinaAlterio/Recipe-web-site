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

    public function getMacroDatabase(RecipesRepository $recipesRepository) {
        $list = $recipesRepository->getListMacro();
        return view('CRUD.macros', compact('list'));
    }

    public function getCategoriesDatabase(RecipesRepository $recipesRepository) {
        if(isset($_GET['id']) && isset($_GET['name'])) {
            $id = $_GET['id'];
            $name= $_GET['name'];
            $list = $recipesRepository->getCategoriesMacro($id);
            return view('CRUD.categorie', compact('list', 'id', 'name'));
        } else {
            $list = $recipesRepository->getCategories();
            return view('CRUD.categorie', compact('list'));
        }

    }

    public function getRecipesDatabase(RecipesRepository $recipesRepository) {
        if(isset($_GET['id']) && isset($_GET['name'])) {
            $id = $_GET['id'];
            $name= $_GET['name'];
            $list = $recipesRepository->getRecipesCategory($id);
            return view('CRUD.recipes_category', compact('list', 'id', 'name'));
        } else {
            $listCategories = $recipesRepository->getCategories();
            $list = $recipesRepository->getAllRecipes();
            $categoriesName = [];
            foreach ($list as $recipe) {
                $recipe_categories[] = DB::select('select rc.id_category from recipe_has_categories as rc join categories as c on c.id = rc.id_category where rc.id_recipe = :id', ['id'=>$recipe->id]);
                foreach ($recipe_categories as $categories) {
                    $recipe->category = $categories;
                    foreach ($categories as $category) {
                        $category->name = $recipesRepository->getCategoryName($category->id_category);
                    }
                }
            }
            return view('CRUD.recipes_category', compact('list', 'listCategories'));
        }


    }


}
