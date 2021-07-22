<?php


namespace App\Http\classes\database\ingredients;

use App\Http\classes\database\Recipes\RecipesRepository;
use Hamcrest\BaseDescription;
use Illuminate\Support\Facades\DB;


class IngredientsRepository
{

    /**
     * recupero tutti gli ingredienti
     *
     * @return array
     */
    public function getAllIngredients() {
        $ingredients = DB::select('select * from ingredients');
        return $ingredients;
    }

    /**
     * recupero ingredienti di una ricetta
     *
     * @param  int  $id_recipe
     * @return array
     */
    public function getRecipeIngredients(int $id_recipe) {
        $list = DB::select('select id_ingredient from recipe_has_ingredients where id_recipe = :id', ['id'=>$id_recipe]);
        $ingredients = [];
        foreach ($list as $value) {
            $ingredients[] = $this->getIngredient($value->id_ingredient);
        }
        return $ingredients;
    }

    /**
     *recupero un determinato ingrediente tramite id
     *
     * @param  int  $id_ingredient
     * @return mixed|null
     */
    public function getIngredient(int $id_ingredient) {
        $ingredient = (DB::select('select * from ingredients where id = :id', ['id'=>$id_ingredient]));
        return $ingredient[0] ?? null;
    }

    /**
     *recupero un determinato ingrediente tramite url
     *
     * @param  string  $url_ingredeint
     * @return mixed|null
     */
    public function getIngredientFromUrl(string $url_ingredeint) {
        $ingredient = (DB::select('select * from ingredients where url = :url and active = :active', ['url'=>$url_ingredeint, 'active'=>1]));
        return $ingredient[0] ?? null;
    }

    /**
     *recupero gli ingredienti attivi
     *
     * @return array|null
     */
    public function getActiveIngredients() {
        $list = DB::select('select * from ingredients where active = :active', ['active'=>1]);
        return $list ?? null;
    }

    /**
     *recupero le descrizioni di un ingrediente
     *
     * @param  string  $url_ingredient
     * @return array|null
     */
    public function getIngredientDescription(string $url_ingredient) {
        $description = DB::select('select * from ingredient_description where url_ingredient = :name', ['name'=>$url_ingredient]);
        return $description ?? null;
    }

    /**
     *inserimento ingrediente
     *
     * @param  string  $name_ingredient
     * @param  string  $url_ingredient
     * @param  int  $active
     */
    public function insertIngredient(string $name_ingredient, string $url_ingredient, int $active) {
        DB::insert('insert into ingredients (name, url, active) values (?, ?, ?)', [$name_ingredient, $url_ingredient, $active]);
    }

    /**
     *inserimento descrizione ingrediente attivo
     *
     * @param  string  $url_ingredient
     * @param  string  $description_ingredient
     * @param  string  $image_ingredient
     */
    public function cudIngredeintDescription(string $url_ingredient, string $description_ingredient, string $image_ingredient) {
        DB::insert('insert into ingrediet_descripti,on (url_ingredient, description, image) values (?, ?)', [$url_ingredient, $description_ingredient, $image_ingredient]);
    }

    /**
     * modifica ingrediente
     *
     * @param  string  $name_ingredient
     * @param  string  $url_ingredient
     * @param  int  $active
     * @param  int  $id_ingredient
     */
    public function updateIngredient(string $name_ingredient, string $url_ingredient, int $active, int $id_ingredient) {
        DB::update('update ingredients set name = :name,url = :url,active = :active where id = :id', ['name'=>$name_ingredient, 'url'=>$url_ingredient, 'active'=>$active, 'id'=>$id_ingredient]);
    }

    /**
     *modifica descrizione ingrediente attivo
     *
     * @param  string  $description_ingredient
     * @param  string  $image_ingredient
     * @param  string  $url_ingredient
     * @param  int  $id_ingredient
     */
    public function updateIngredientDescription(string $description_ingredient, string $image_ingredient , string $url_ingredient, int $id_ingredient) {
        DB::update('update ingredients_description set description = :description, image = :image, url_ingredient = :url where id = :id', ['description'=>$description_ingredient,'image'=>$image_ingredient, 'url'=>$url_ingredient, 'id'=>$id_ingredient]);
    }

    /**
     * cancellazione ingrediente
     *
     * @param  int  $id_ingredient
     */
    public function deleteIngredient(int $id_ingredient) {
        DB::delete('delete from ingredients where id = :id', ['id'=>$id_ingredient]);
    }

    /**
     * cancellazione descrizione ingrediente attivo
     *
     * @param  int  $id_ingrediente
     */
    public function deleteIngredientDescription(int $id_ingrediente) {
        DB::delete('delete from ingredient_description where id = :id', ['id'=>$id_ingrediente]);
    }
}
