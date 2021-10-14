<?php


namespace App\Http\Classes\Database\Recipes;

use App\Models\Category;
use App\Models\CategoryCategory;
use App\Models\CategoryRecipe;
use App\Models\IngredientRecipe;
use App\Models\Recipe;
use App\Models\RecipeMethod;
use App\Models\RecipeRecipe;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Eloquent\Collection;


class RecipesRepository
{

    /**
     * Recupero lista macro categorie e relativi dati
     *
     * @return Collection|null
     * @throws Exception
     */
    public function getListMacro(): ?Collection
    {
        try {
            return Category::where('macro', 1)
                            ->get();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero delle macrocategorie.");
        }
    }

    /**
     * id delle categorie associate ad una macro e relativi dati
     *
     * @param  int  $id_macro
     * @return Collection|null
     * @throws Exception
     */
    public function getCategoriesMacro(int $id_macro): ?Collection
    {
        try {
            return Category::find($id_macro)
                            ->category()
                            ->get();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero delle categorie associate alla macro.");
        }

    }

    /**
     * recupero l'elenco completo delle categorie e relativi dati
     *
     * @return Collection|null
     * @throws Exception
     */
    public function getCategories(): ?Collection
    {
        try {
            return Category::get();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero delle categorie.");
        }

    }

    /**
     *recupero tutti i dati di una categoria
     *
     * @param  string  $url_category
     * @return mixed
     * @throws Exception
     */
    public function getCategoryFromUrl(string $url_category)
    {
        try {
            return Category::where('url', $url_category)
                            ->first();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero della categoria tramite url.");
        }
    }

    /**
     * recupero tutti i dati di una categoria
     *
     * @param  int  $id_category
     * @return mixed
     * @throws Exception
     */
    public function getCategory(int $id_category) {
        try {
            return Category::where('id', $id_category)
                            ->first();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero della categoria tramite id.");
        }
    }

    /**
     * @param  int  $id_recipe
     * @return mixed|null
     * @throws Exception
     */
    public function getCategoryFromRecipe(int $id_recipe)
    {
        try {
            return Recipe::find($id_recipe)
                            ->category()
                            ->first();
        } catch (Exception $e) {
            throw new Exception('SI è verificato un errore nel recupero della categoria associata alla ricetta');
        }
    }

    /**
     * recupero tutti i dati di una ricetta
     *
     * @param  string  $url_recipe
     * @return mixed
     * @throws Exception
     */
    public function getRecipeFromUrl(string $url_recipe)
    {
        try {
            return Recipe::where('url', $url_recipe)
                            ->first();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero della ricetta tramite l'url.");
        }
    }


    /**
     * recupero tutti i dati di una ricetta
     *
     * @param  int  $id_recipe
     * @return mixed|null
     * @throws Exception
     */
    public function getRecipe(int $id_recipe)
    {
        try {
            $recipe = Recipe::where('active', 1)
                            ->where('id', $id_recipe)
                            ->first();
            return $recipe ?? null;
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero della ricetta tramite l'id.");
        }
    }

    /**
     *recupero tutte le ricette associate ad una categoria
     *
     * @param  int  $id_category
     * @return array
     * @throws Exception
     */
    public function getCategoryRecipes(int $id_category): ?Collection
    {
        try {
            return Category::find($id_category)
                            ->recipe()
                            ->get();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero delle ricette associate alla categoria.");
        }
    }

    /**
     * recupero l'elenco completo delle ricette
     *
     * @return Collection|null
     * @throws Exception
     */
    public function getAllRecipes(): ?Collection
    {
        try {
            Return Recipe::get();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero delle ricette.");
        }
    }

    /**
     * recupero gli id delle ricette associate ad una ricetta
     *
     * @param  int  $id_recipe
     * @return array
     * @throws Exception
     */
    public function getLinkedRecipes (int $id_recipe): ?Collection
    {
        try {
            return Recipe::find($id_recipe)
                            ->recipe()
                            ->get();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero delle ricette collegare alla ricetta.");
        }
    }

    /**
     * recupero i metodi di una data ricetta
     *
     * @param  int  $id_recipe
     * @return Collection
     * @throws Exception
     */
    public function  getRecipeMethods (int $id_recipe): ?Collection
    {
        try {
            return RecipeMethod::where('recipe_id', $id_recipe)
                                ->get();
        } catch(Exception $e) {

            throw new Exception("Si è verificato un errore nel recupero dei procedimenti della ricetta.");
        }
    }

    /**
     * @param  int  $id_recipe
     * @return Collection|null
     * @throws Exception
     */
    public function getRecipesLinkedToRecipe(int $id_recipe): ?Collection
    {
        try{
            return Recipe::find($id_recipe)
                            ->recipe()
                            ->get();
        } catch (Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero delle ricette collegate alla ricetta");
        }
    }

    /**
     * inserimento ricetta
     *
     * @param  string  $name_recipe
     * @param  string  $url_recipe
     * @param  string  $subheading_recipe
     * @param  string  $image_recipe
     * @param  int  $active_recipe
     * @throws Exception
     */
    public function insertRecipe(string $name_recipe, string $url_recipe, string $subheading_recipe, string $image_recipe, int $active_recipe) {
        try {
            Recipe::insert([
                'name' => $name_recipe,
                'url' => $url_recipe,
                'subheading' => $subheading_recipe,
                'image' => $image_recipe,
                'active' => $active_recipe
            ]);
            //DB::insert('insert into recipes (name, url, subheading, image, active) values (?, ?, ?, ?, ?)', [$name_recipe, $url_recipe, $subheading_recipe, $image_recipe, $active_recipe]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nell'inseriemnto della ricetta.");
        }
    }

    /**
     * modifaca ricetta
     *
     * @param  string|null  $name_recipe
     * @param  string|null  $url_recipe
     * @param  string|null  $subheading_recipe
     * @param  string|null  $image_recipe
     * @param  int|null  $active_recipe
     * @param  int  $id_recipe
     * @throws Exception
     */
    public function updateRecipe(?string $name_recipe, ?string $url_recipe, ?string $subheading_recipe, ?string $image_recipe, ?int $active_recipe, int $id_recipe) {
        try {
            Recipe::where('id', $id_recipe)
                    ->update([
                        'name' => $name_recipe,
                        'url' => $url_recipe,
                        'subheading' => $subheading_recipe,
                        'image' => $image_recipe,
                        'active' => $active_recipe
                    ]);
            //DB::update('update recipes set name= :name, url= :url, subheading= :subheading, image= :image, active= :active where id = :id', ['name'=>$name_recipe, 'url'=>$url_recipe, 'subheading'=>$subheading_recipe, 'image'=>$image_recipe, 'active'=>$active_recipe, 'id'=>$id_recipe]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nella modifica della ricetta.");
        }
    }

    /**
     * cancellazione ricetta
     *
     * @param  int  $id_recipe
     * @throws Exception
     */
    public function deleteRecipe(int $id_recipe) {
        try {
            Recipe::where('id', $id_recipe)
                    ->delete();
            //DB::delete('delete from recipes where id= :id', ['id'=>$id_recipe]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nella cancellazione della ricetta.");
        }
    }

    /**
     * inserimento ingredienti di una ricetta
     *
     * @param  int  $id_recipe
     * @param  array  $ingredients
     * @throws Exception
     */
    public function insertRecipeIngredients(int $id_recipe, array $ingredients) {
        try {
            IngredientRecipe::where('recipe_id', $id_recipe)
                            ->delete();
            //DB::delete('delete from ingredient_recipe where recipe_id= :id', [$id_recipe]);
            foreach ($ingredients as $ingredient) {
                IngredientRecipe::insert([
                    'recipe_id' => $id_recipe,
                    'ingredient_id' => $ingredient['id_ingredient'],
                    'quantity' => $ingredient['quantity']
                ]);
                //DB::insert('insert into ingredient_recipe (recipe_id, ingredient_id, quantity) values(?,?,?)', [$id_recipe, $ingredient['id_ingredient'], $ingredient['quantity']]);
            }
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nell'inserimento degli ingredienti della ricetta.");
        }
    }

    /**
     * insetimento metodo e immagine ricetta
     *
     * @param  string  $method
     * @param  string  $image
     * @param  int  $id_recipe
     * @throws Exception
     */
    public function insertMethod (string $method, string $image, int $id_recipe) {
        try {
            RecipeMethod::insert([
                'method' => $method,
                'image' => $image,
                'recipe_id' => $id_recipe
            ]);
            //DB::insert('insert into methods (method, image, id_recipe) value (?,?,?)', [$method, $image, $id_recipe]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero delle categorie associate alla macro.");
        }
    }

    /**
     *modifica metodo e immagine ricetta
     *
     * @param  string  $method
     * @param  string  $image
     * @param  int  $id_recipe
     * @throws Exception
     */
    public function updateMethod(string $method, string $image, int $id_method) {
        try {
            RecipeMethod::where('id', $id_method)
                        ->update([
                            'method' => $method,
                            'image' => $image
                        ]);
            //DB::update('update methods set method= :method, image= :image where id= :id', ['method'=>$method, 'image'=>$image, 'id'=>$id_recipe]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nella modifica del procediemtno della ricetta.");
        }
    }

    /**
     *cancellazione metodo e immagine ricetta
     *
     * @param  int  $id_method
     * @throws Exception
     */
    public function deleteMethod(int $id_method) {
        try {
            RecipeMethod::where('id', $id_method)
                        ->delete();
            //DB::delete('delete from methods where id= :id', ['id'=>$id]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nella cancellazione del procedimento della ricetta.");
        }
    }

    /**
     * inserimento ricette associate ad una ricetta
     *
     * @param  int  $id_recipe
     * @param  array  $id_linked_recipes
     * @throws Exception
     */
    public function insertLinkedRecipes(int $id_recipe, array $id_linked_recipes) {
        try {
            RecipeRecipe::where('recipe_id', $id_recipe)
                        ->delete();
            //DB::delete('delete from recipe_recipe  where id_Recipe= :id', [$id_recipe]);
            foreach ($id_linked_recipes as $id_linked_recipe) {
                RecipeRecipe::insert([
                    'recipe_id' => $id_recipe,
                    'linked_recipe_id' => $id_linked_recipe
                ]);
                //DB::insert('insert into recipe_recipe  (id_recipe, id_linked_Recipe) value (?,?)', [$id_recipe, $id_linked_recipe]);
            }
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nell'inserimento delle ricette associate alla ricetta.");
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
     * @throws Exception
     */
    public function insertCategory(string $name_category, string $url_category, int $macro_category, string $image_category, string $description_category){
        try {
            Category::insert([
                'name' => $name_category,
                'url' => $url_category,
                'macro' => $macro_category,
                'image' => $image_category,
                'description' => $description_category
            ]);
            //DB::insert('insert into categories (name, url, macro, image, description) value (?,?,?,?,?)', [$name_category, $url_category, $macro_category, $image_category, $description_category]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nell'inserimento della categoria.");
        }
    }

    /**
     * modifica categoria
     *
     * @param  string  $name_category
     * @param  string|null  $url_category
     * @param  int|null  $macro_category
     * @param  string|null  $image_category
     * @param  string|null  $description_category
     * @param  int  $id_category
     * @throws Exception
     */
    public function updateCategory(string $name_category, ?string $url_category, ?int $macro_category, ?string $image_category, ?string $description_category, int $id_category){
        try {
            Category::where('id', $id_category)
                    ->update([
                        'name' => $name_category,
                        'url' => $url_category,
                        'macro' => $macro_category,
                        'image' => $image_category,
                        'description' => $description_category
                    ]);
            //DB::update('update categories set name= :name, url= :url, macro= :macro, image= :image, description= :description where id= :id', ['name'=>$name_category, 'url'=>$url_category, 'macro'=>$macro_category, 'image'=>$image_category, 'description'=>$description_category, 'id'=>$id_category]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nella modifica della categoria.");
        }
    }

    /**
     * cancellazione categoria
     *
     * @param  int  $id_category
     * @throws Exception
     */
    public function deleteCategory(int $id_category){
        try {
            Category::where('id', $id_category)
                    ->delete();
            //DB::delete('delete from categories where id= :id', [$id_category]);
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nella cancellazione della categoria.");
        }
    }

    /**
     * inserimento ricette associate a categoria
     *
     * @param  int  $id_category
     * @param  array  $id_recipes
     * @throws Exception
     */
    public function insertCategoryRecipes(int $id_category, array $id_recipes) {
      try {
          CategoryRecipe::where('category_id', $id_category)
                        ->delete();
          //DB::delete('delete from recipe_category where category_id= :id_category', [$id_category]);
          foreach ($id_recipes as $id_recipe) {
              CategoryRecipe::insert([
                  'category_id' => $id_category,
                  'recipe_id' => $id_recipe
              ]);
              //DB::insert('insert into recipe_category (recipe_id, category_id) value (?,?)', [$id_recipe, $id_category]);
          }
      } catch(Exception $e) {
          throw new Exception("Si è verificato un errore nell'insermiento delle ricette associate alla categoria");
      }
    }

    /**
     * inserimento categorie associate a macro
     *
     * @param  int  $id_macro
     * @param  array  $id_categories
     * @throws Exception
     */
    public function insertMacroCategories(int $id_macro, array $id_categories) {
        try {
            CategoryCategory::where('macrocategory_id', $id_macro)
                            ->delete();
            //DB::select('delete from category_category where id_macrocategory= :id_macro', [$id_macro]);
            foreach ($id_categories as $id_category) {
                CategoryCategory::insert([
                    'macrocategory_id' => $id_macro,
                    'category_id' => $id_category
                ]);
                //DB::insert('insert into category_category (id_macrocategory, id_category) value (?,?)', [$id_macro, $id_category]);
            }
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nell'inserimento delle categorie associate alla macro.");
        }
    }
}
