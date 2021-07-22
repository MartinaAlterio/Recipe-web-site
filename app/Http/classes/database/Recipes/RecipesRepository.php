<?php


namespace App\Http\classes\database\Recipes;

use App\Http\classes\database\ingredients\IngredientsRepository;
use Illuminate\Support\Facades\DB;
use Exception;


class RecipesRepository
{

    /**
     * Recupero lista macro categorie e relativi dati
     *
     * @return array|null
     */
    public function getListMacro() {
        try {
            $list = (DB::select('Select * from categories where macro = :macro', ['macro'=>true]));
        } catch(Exception $e) {

        }
        return $list ?? null;
    }

    /**
     * id delle categorie associate ad una macro e relativi dati
     *
     * @param  int  $id_macro
     * @return array
     */
    public function getCategoriesMacro(int $id_macro) {
        try {
            $list = (DB::select('select id_category from category_has_categories where id_macrocategory = :id', ['id'=>$id_macro]));
        } catch(Exception $e) {

        }
        $category = [];
        foreach ($list as $value) {
            try {
                $category[] = $this->getCategory($value->id_category);
            } catch (Exception $e) {

            }
        }
        return $category;
    }

    /**
     * recupero l'elenco completo delle categorie e relativi dati
     *
     * @return array|null
     */
    public function getCategories() {
        try {
            $list = DB::select('select * from categories');
        } catch(Exception $e) {

        }
        return $list ?? null;
    }

    /**
     *recupero tutti i dati di una categoria
     *
     * @param  string  $url_category
     * @return mixed|null
     */
    public function getCategoryFromUrl(string $url_category) {
        try {
            $category = DB::select('Select * from categories where url = :url', ['url'=>$url_category]);
        } catch(Exception $e) {

        }
        return $category[0] ?? null;
    }

    /**
     * recupero tutti i dati di una categoria
     *
     * @param  int  $id_category
     * @return mixed|null
     */
    public function getCategory(int $id_category) {
        try {
            $category = (DB::select('select * from categories where id = :id', ['id'=>$id_category]));
        } catch(Exception $e) {

        }
        return $category[0] ?? null;
    }

    /**
     * recupero tutti i dati di una ricetta
     *
     * @param  string  $url_recipe
     * @return mixed|null
     */
    public function getRecipeFromUrl(string $url_recipe) {
        try {
            $recipe = (DB::select('select * from recipes where url = :url', ['url'=>$url_recipe]));
        } catch(Exception $e) {

        }
        return $recipe[0] ?? null;
}

    /**
     * recupero tutti i dati di una ricetta
     *
     * @param  int  $id_recipe
     * @return mixed|null
     */
    public function getRecipe(int $id_recipe) {
        try {
            $recipe = (DB::select('select * from recipes where id = :id', ['id'=>$id_recipe]));
        } catch(Exception $e) {

        }
        return $recipe[0] ?? null;
    }

    /**
     *recupero tutte le ricette associate ad una categoria
     *
     * @param  int  $id_category
     * @return array
     */
    public function getCategoryRecipes(int $id_category) {
        try {
            $categories = (DB::select('select id_recipe from recipe_has_categories where id_category = :id', ['id'=>$id_category]));
        } catch(Exception $e) {

        }
        $recipes = [];
        foreach ($categories as $category) {
            $recipes[] = $this->getRecipe($category->id_recipe);
        }
        return $recipes;
    }

    /**
     * recupero l'elenco completo delle ricette
     *
     * @return array
     */
    public function getAllRecipes() {
        try {
            $list = DB::select('select * from recipes');
        } catch(Exception $e) {

        }
        return $list;
    }

    /**
     * recupero gli id delle ricette associate ad una ricetta
     *
     * @param  int  $id_recipe
     * @return array
     */
    public function getLinkedRecipes (int $id_recipe) {
        try {
            $linked_recipes= DB::select('select * from recipe_has_recipes where id_recipe= :id', ['id'=>$id_recipe]);
        } catch(Exception $e) {

        }
        return $linked_recipes;
    }

    /**
     * recupero i metodi di una data ricetta
     *
     * @param  int  $id_recipe
     * @return array
     */
    public function  getRecipeMethods (int $id_recipe) {
        try {
            $methods = DB::select('select * from methods where id_recipe = :id', ['id'=>$id_recipe]);
        } catch(Exception $e) {
        }
        return $methods;
    }

    /**
     * inserimento ricetta
     *
     * @param  string  $name_recipe
     * @param  string  $url_recipe
     * @param  string  $subheading_recipe
     * @param  string  $image_recipe
     * @param  string  $active_recipe
     */
    public function insertRecipe(string $name_recipe, string $url_recipe, string $subheading_recipe, string $image_recipe, string $active_recipe) {
        try {
            DB::insert('insert into recipes (name, url, subheading, image, active) values (?, ?, ?, ?, ?)', [$name_recipe, $url_recipe, $subheading_recipe, $image_recipe, $active_recipe]);
        } catch(Exception $e) {

        }
    }

    /**
     * modifaca ricetta
     *
     * @param  string  $name_recipe
     * @param  string  $url_recipe
     * @param  string  $subheading_recipe
     * @param  string  $image_recipe
     * @param  int  $active_recipe
     * @param  int  $id_recipe
     */
    public function updateRecipe(string $name_recipe, string $url_recipe, string $subheading_recipe, string $image_recipe, int $active_recipe, int $id_recipe) {
    try {
        DB::update('update recipes set name= :name, url= :url, subheading= :subheading, image= :image, active= :active where id = :id', ['name'=>$name_recipe, 'url'=>$url_recipe, 'subheading'=>$subheading_recipe, 'image'=>$image_recipe, 'active'=>$active_recipe, 'id'=>$id_recipe]);
    } catch(Exception $e) {

    }
    }

    /**
     * cancellazione ricetta
     *
     * @param  int  $id_recipe
     */
    public function deleteRecipe(int $id_recipe) {
        try {
            DB::delete('delete from recipes where id= :id', ['id'=>$id_recipe]);
        } catch(Exception $e) {

        }
    }

    /**
     * inserimento ingredienti di una ricetta
     *
     * @param  int  $id_recipe
     * @param  array  $id_ingredients
     */
    public function insertRecipeIngredients(int $id_recipe, array $id_ingredients) {
        try {
            DB::delete('delete from recipe_has_ingredients where id_recipe= :id', [$id_recipe]);
        } catch(Exception $e) {

        }
        foreach ($id_ingredients as $id_ingredient) {
            DB::insert('insert into recipe_has_ingredients (id_recipe, id_ingredient) values(?,?)', [$id_recipe, $id_ingredient]);
        }
    }

    /**
     * insetimento metodo e immagine ricetta
     *
     * @param  string  $method
     * @param  string  $image
     * @param  int  $id_recipe
     */
    public function insertMethod (string $method, string $image, int $id_recipe) {
        try {
            DB::insert('insert into methods (method, image, id_recipe) value (?,?,?)', [$method, $image, $id_recipe]);
        } catch(Exception $e) {

        }
    }

    /**
     *modifica metodo e immagine ricetta
     *
     * @param  string  $method
     * @param  string  $image
     * @param  int  $id_recipe
     */
    public function updateMethod(string $method, string $image, int $id_recipe) {
        try {
            DB::update('update methods set method= :method, image= :image where id= :id', ['method'=>$method, 'image'=>$image, 'id'=>$id_recipe]);
        } catch(Exception $e) {

        }
    }

    /**
     *cancellazione metodo e immagine ricetta
     *
     * @param  int  $id
     */
    public function deleteMethod(int $id) {
        try {
            DB::delete('delete from methods where id= :id', ['id'=>$id]);
        } catch(Exception $e) {

        }
    }

    /**
     * inserimento ricette associate ad una ricetta
     *
     * @param  int  $id_recipe
     * @param  array  $id_linked_recipes
     */
    public function insertLinkedRecipes(int $id_recipe, array $id_linked_recipes) {
        try {
            DB::delete('delete from recipe_has_recipes where id_Recipe= :id', [$id_recipe]);
        } catch(Exception $e) {

        }
        foreach ($id_linked_recipes as $id_linked_recipe) {
            DB::insert('insert into recipe_has_recipes (id_recipe, id_linked_Recipe) value (?,?)', [$id_recipe, $id_linked_recipe]);
        }
    }

    /**
     *inserimento categoria
     *
     * @param  string  $name_category
     * @param  string  $url_category
     * @param  int  $macro_category
     * @param  string  $image_category
     * @param  string  $description_category
     */
    public function insertCategory(string $name_category, string $url_category, int $macro_category, string $image_category, string $description_category){
        try {
            DB::insert('insert into categories (name, url, macro, image, description) value (?,?,?,?,?)', [$name_category, $url_category, $macro_category, $image_category, $description_category]);
        } catch(Exception $e) {

        }
    }

    /**
     * modifica categoria
     *
     * @param  string  $name_category
     * @param  string  $url_category
     * @param  int  $macro_category
     * @param  string  $image_category
     * @param  string  $description_category
     * @param  int  $id_category
     */
    public function updateCategory(string $name_category, string $url_category, int $macro_category, string $image_category, string $description_category, int $id_category){
        try {
            DB::update('update categories set name= :name, url= :url, macro= :macro, image= :image, description= :description where id= :id', ['name'=>$name_category, 'url'=>$url_category, 'macro'=>$macro_category, 'image'=>$image_category, 'description'=>$description_category, 'id'=>$id_category]);
        } catch(Exception $e) {

        }
    }

    /**
     * cancellazione categoria
     *
     * @param  int  $id_category
     */
    public function deleteCategory(int $id_category){
        try {
            DB::delete('delete from categories where id= :id', [$id_category]);
        } catch(Exception $e) {

        }
    }

    /**
     * inserimento ricette associate a categoria
     *
     * @param  int  $id_category
     * @param  array  $id_recipes
     */
    public function insertCategoryRecipes(int $id_category, array $id_recipes) {
      try {
          DB::delete('delete from recipe_has_categories where id_category= :id_category', [$id_category]);
      } catch(Exception $e) {

      }
        foreach ($id_recipes as $id_recipe) {
            DB::insert('insert into recipe_has_categories (id_recipe, id_category) value (?,?)', [$id_recipe, $id_category]);
        }
    }

    /**
     * inserimento categorie associate a macro
     *
     * @param  int  $id_macro
     * @param  array  $id_categories
     */
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
