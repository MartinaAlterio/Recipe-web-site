<?php


namespace App\Http\classes\database\Recipes;

use App\Http\classes\database\ingredients\IngredientsRepository;
use Illuminate\Support\Facades\DB;


class RecipesRepository
{

    //metodi per recuperare i dati dal database
    public function getListMacro() {
        $list = (DB::select('Select * from categories where macro = :macro', ['macro'=>true]));
        return $list ?? null;
    }
    public function getImageMacro(int $id) {
        $image = (DB::select('select image from categories where id = :id', ['id'=>$id]));
        return $image[0] ?? null;
    }

    public function getCategoriesMacro(int $id) {
        $list = (DB::select('select id_category from category_has_categories where id_macrocategory = :id', ['id'=>$id]));
        $category = [];
        foreach ($list as $value) {
            $category[] = $this->getCategory($value->id_category);
        }
        return $category;
    }

    public function getCategories() {
        $list = DB::select('select * from categories');
        return $list ?? null;
    }

    public function getCategoryFromUrl(string $url) {
        $category = DB::select('Select * from categories where url = :url', ['url'=>$url]);
        return $category[0] ?? null;
    }

    public function getCategory(int $id) {
        $category = (DB::select('select * from categories where id = :id', ['id'=>$id]));
        return $category[0] ?? null;
    }

    public function getCategoryName($id) {
        $nameCategory = DB::select('select name from categories where id = :id', ['id'=>$id]);
        return $nameCategory[0]->name ?? null;
    }

    public function getRecipeFromUrl(string $url) {
        $recipe = (DB::select('select * from recipes where url = :url', ['url'=>$url]));
        return $recipe[0] ?? null;
}

    public function getRecipe(int $id) {
        $recipe = (DB::select('select * from recipes where id = :id', ['id'=>$id]));
        return $recipe[0] ?? null;
    }

    public function getRecipesCategory(int $id_category) {
        $list = (DB::select('select id_recipe from recipe_has_categories where id_category = :id', ['id'=>$id_category]));
        $recipes = [];
        foreach ($list as $value) {
            $recipes[] = $this->getRecipe($value->id_recipe);
        }
        return $recipes;
    }

    public function getAllRecipes() {
        $list = DB::select('select * from recipes');
        return $list;
    }

    public function getImportantRecipesCategory(int $id_category) {
        $list = DB::select('select rc.id_recipe from recipe_has_categories as rc join recipes as r on r.id = rc.id_recipe where r.important = :important and rc.id_category = :id', ['important'=>1 ,'id'=>$id_category]);
        $recipes = [];
        foreach ($list as $value) {
            $recipes[] = $this->getRecipe($value->id_recipe);
        }
        return $recipes;
    }

    public function getLinkedRecipes (int $id_recipe) {
        $linked_recipes= DB::select('select * from recipe_has_recipes where id_recipe= :id', ['id'=>$id_recipe]);
        return $linked_recipes;
    }

    public function  getRecipeMethods (int $id_recipe) {
        $methods = DB::select('select * from methods where id_recipe = :id', ['id'=>$id_recipe]);
        return $methods;
    }

    //metodi di inserimento dati nel database
    public function insertRecipe(string $name, string $url, string $subheading, string $image, string $active) {
        DB::insert('insert into recipes (name, url, subheading, image, active) values (?, ?, ?, ?, ?)', [$name, $url, $subheading, $image, $active]);
    }

    public function insertRecipeIngredient(int $id_recipe, string $name, string $url, int $active, IngredientsRepository $ingredientsRepository){
            $ingredientsRepository->insertIngredient($name, $url, $active);
            /*$id_ingredient = DB::select('select id from ingredients where name = :name', ['name'=>$value]);
            DB::insert('insert into recipe_has_ingredients (id_recipe, id_ingredient) values (?, ?)', [$id_recipe, $id_ingredient]);*/
    }

    //metodi per la modifica dei dati nel database
    public function updateRecipe(string $name, string $url, string $subheading, string $image, string $active, int $id) {
    DB::update('update recipes set name= :name, url= :url, subheading= :subheading, image= :image, active= :active where id = :id', ['name'=>$name, 'url'=>$url, 'subheading'=>$subheading, 'image'=>$image, 'active'=>$active, 'id'=>$id]);
    }

    //metodi per la rimozione di dati nel database
    public function deleteRecipe(int $id) {
        DB::delete('delete from recipes where id= :id', ['id'=>$id]);
    }

    public function insertRecipeIngredients(int $id_recipe, array $id_ingredients) {
        DB::delete('delete from recipe_has_ingredients where id_recipe= :id', [$id_recipe]);
        foreach ($id_ingredients as $id_ingredient) {
            DB::insert('insert into recipe_has_ingredients (id_recipe, id_ingredient) values(?,?)', [$id_recipe, $id_ingredient]);
        }
    }

    public function insertMethod (string $method, string $image, int $id_recipe) {
        DB::insert('insert into methods (method, image, id_recipe) value (?,?,?)', [$method, $image, $id_recipe]);
    }

    public function updateMethod(string $method, string $image, int $id) {
        DB::update('update methods set method= :method, image= :image where id= :id', ['method'=>$method, 'image'=>$image, 'id'=>$id]);
    }

    public function deleteMethod(int $id) {
        DB::delete('delete from methods where id= :id', ['id'=>$id]);
    }

    public function insertLinkedRecipes(int $id_recipe, array $id_linked_recipes) {
        DB::delete('delete from recipe_has_recipes where id_Recipe= :id', [$id_recipe]);
        foreach ($id_linked_recipes as $id_linked_recipe) {
            DB::insert('insert into recipe_has_recipes (id_recipe, id_linked_Recipe) value (?,?)', [$id_recipe, $id_linked_recipe]);
        }
    }
}
