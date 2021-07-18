<?php


namespace App\Http\classes\database\Recipes;

use App\Http\classes\database\ingredients\IngredientsRepository;
use Illuminate\Support\Facades\DB;
use Exception;


class RecipesRepository
{

    //metodi per recuperare i dati dal database
    public function getListMacro() {
        try {
            $list = (DB::select('Select * from categories where macro = :macro', ['macro'=>true]));
        } catch(Exception $e) {
        }

        return $list ?? null;
    }
    public function getImageMacro(int $id) {
        try {
            $image = (DB::select('select image from categories where id = :id', ['id'=>$id]));
        } catch(Exception $e) {

        }

        return $image[0] ?? null;
    }

    public function getCategoriesMacro(int $id) {
        try {
            $list = (DB::select('select id_category from category_has_categories where id_macrocategory = :id', ['id'=>$id]));
        } catch(Exception $e) {

        }
        $category = [];
        foreach ($list as $value) {
            $category[] = $this->getCategory($value->id_category);
        }
        return $category;
    }

    public function getCategories() {
        try {
            $list = DB::select('select * from categories');
        } catch(Exception $e) {

        }
        return $list ?? null;
    }

    public function getCategoryFromUrl(string $url) {
        try {
            $category = DB::select('Select * from categories where url = :url', ['url'=>$url]);
        } catch(Exception $e) {

        }
        return $category[0] ?? null;
    }

    public function getCategory(int $id) {
        try {
            $category = (DB::select('select * from categories where id = :id', ['id'=>$id]));
        } catch(Exception $e) {

        }
        return $category[0] ?? null;
    }

    public function getCategoryName($id) {
        try {
            $nameCategory = DB::select('select name from categories where id = :id', ['id'=>$id]);
        } catch(Exception $e) {

        }
        return $nameCategory[0]->name ?? null;
    }

    public function getRecipeFromUrl(string $url) {
        try {
            $recipe = (DB::select('select * from recipes where url = :url', ['url'=>$url]));
        } catch(Exception $e) {

        }
        return $recipe[0] ?? null;
}

    public function getRecipe(int $id) {
        try {
            $recipe = (DB::select('select * from recipes where id = :id', ['id'=>$id]));
        } catch(Exception $e) {

        }
        return $recipe[0] ?? null;
    }

    public function getRecipesCategory(int $id_category) {
        try {
            $list = (DB::select('select id_recipe from recipe_has_categories where id_category = :id', ['id'=>$id_category]));
        } catch(Exception $e) {

        }
        $recipes = [];
        foreach ($list as $value) {
            $recipes[] = $this->getRecipe($value->id_recipe);
        }
        return $recipes;
    }

    public function getAllRecipes() {
        try {
            $list = DB::select('select * from recipes');
        } catch(Exception $e) {

        }
        return $list;
    }

    public function getImportantRecipesCategory(int $id_category) {
        try {
            $list = DB::select('select rc.id_recipe from recipe_has_categories as rc join recipes as r on r.id = rc.id_recipe where r.important = :important and rc.id_category = :id', ['important'=>1 ,'id'=>$id_category]);
        } catch(Exception $e) {

        }
        $recipes = [];
        foreach ($list as $value) {
            $recipes[] = $this->getRecipe($value->id_recipe);
        }
        return $recipes;
    }

    public function getLinkedRecipes (int $id_recipe) {
        try {
            $linked_recipes= DB::select('select * from recipe_has_recipes where id_recipe= :id', ['id'=>$id_recipe]);
        } catch(Exception $e) {

        }
        return $linked_recipes;
    }

    public function  getRecipeMethods (int $id_recipe) {
        try {
            $methods = DB::select('select * from methods where id_recipe = :id', ['id'=>$id_recipe]);
        } catch(Exception $e) {
        }
        return $methods;
    }

    //metodi di inserimento dati nel database
    public function insertRecipe(string $name, string $url, string $subheading, string $image, string $active) {
        try {
            DB::insert('insert into recipes (name, url, subheading, image, active) values (?, ?, ?, ?, ?)', [$name, $url, $subheading, $image, $active]);
        } catch(Exception $e) {

        }
    }

    //metodi per la modifica dei dati nel database
    public function updateRecipe(string $name, string $url, string $subheading, string $image, int $active, int $id) {
    try {
        DB::update('update recipes set name= :name, url= :url, subheading= :subheading, image= :image, active= :active where id = :id', ['name'=>$name, 'url'=>$url, 'subheading'=>$subheading, 'image'=>$image, 'active'=>$active, 'id'=>$id]);
    } catch(Exception $e) {

    }
    }

    //metodi per la rimozione di dati nel database
    public function deleteRecipe(int $id) {
        try {
            DB::delete('delete from recipes where id= :id', ['id'=>$id]);
        } catch(Exception $e) {

        }
    }

    public function insertRecipeIngredients(int $id_recipe, array $id_ingredients) {
        try {
            DB::delete('delete from recipe_has_ingredients where id_recipe= :id', [$id_recipe]);
        } catch(Exception $e) {

        }
        foreach ($id_ingredients as $id_ingredient) {
            DB::insert('insert into recipe_has_ingredients (id_recipe, id_ingredient) values(?,?)', [$id_recipe, $id_ingredient]);
        }
    }

    public function insertMethod (string $method, string $image, int $id_recipe) {
        try {
            DB::insert('insert into methods (method, image, id_recipe) value (?,?,?)', [$method, $image, $id_recipe]);
        } catch(Exception $e) {

        }
    }

    public function updateMethod(string $method, string $image, int $id) {
        try {
            DB::update('update methods set method= :method, image= :image where id= :id', ['method'=>$method, 'image'=>$image, 'id'=>$id]);
        } catch(Exception $e) {

        }
    }

    public function deleteMethod(int $id) {
        try {
            DB::delete('delete from methods where id= :id', ['id'=>$id]);
        } catch(Exception $e) {

        }
    }

    public function insertLinkedRecipes(int $id_recipe, array $id_linked_recipes) {
        try {
            DB::delete('delete from recipe_has_recipes where id_Recipe= :id', [$id_recipe]);
        } catch(Exception $e) {

        }
        foreach ($id_linked_recipes as $id_linked_recipe) {
            DB::insert('insert into recipe_has_recipes (id_recipe, id_linked_Recipe) value (?,?)', [$id_recipe, $id_linked_recipe]);
        }
    }

    public function insertCategory(string $name, string $url, int $macro, string $image, string $description){
        try {
            DB::insert('insert into categories (name, url, macro, image, description) value (?,?,?,?,?)', [$name, $url, $macro, $image, $description]);
        } catch(Exception $e) {

        }
    }

    public function updateCategory(string $name, string $url, int $macro, string $image, string $description, int $id){
        try {
            DB::update('update categories set name= :name, url= :url, macro= :macro, image= :image, description= :description where id= :id', ['name'=>$name, 'url'=>$url, 'macro'=>$macro, 'image'=>$image, 'description'=>$description, 'id'=>$id]);
        } catch(Exception $e) {

        }
    }

    public function deleteCategory(int $id){
        try {
            DB::delete('delete from categories where id= :id', [$id]);
        } catch(Exception $e) {

        }
    }

    public function insertCategoryRecipes(int $id_category, array $id_recipes) {
      try {
          DB::delete('delete from recipe_has_categories where id_category= :id_category', [$id_category]);
      } catch(Exception $e) {

      }
        foreach ($id_recipes as $id_recipe) {
            DB::insert('insert into recipe_has_categories (id_recipe, id_category) value (?,?)', [$id_recipe, $id_category]);
        }
    }

    public function insertMacroCategories(int $id_macro, array $id_categories) {
        try {
            DB::select('delete from category_has_categories where id_macrocategory= :id_macro', [$id_macro]);
        } catch(Exception $e) {

        }
        foreach ($id_categories as $id_category) {
            DB::insert('insert into category_has_categories (id_macrocategory, id_category) value (?,?)', [$id_macro, $id_category]);
        }
    }
}
