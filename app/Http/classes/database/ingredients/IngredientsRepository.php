<?php


namespace App\Http\classes\database\ingredients;

use App\Http\classes\database\Recipes\RecipesRepository;
use Hamcrest\BaseDescription;
use Illuminate\Support\Facades\DB;


class IngredientsRepository
{
    //metodi per il recupero dei dati dal database
    public function getAllIngredients() {
        $ingredients = DB::select('select * from ingredients');
        return $ingredients;
    }

    public function getIngredientsRecipe(int $id_recipe) {
        $list = DB::select('select id_ingredient from recipe_has_ingredients where id_recipe = :id', ['id'=>$id_recipe]);
        $ingredients = [];
        foreach ($list as $value) {
            $ingredients[] = $this->getIngedient($value->id_ingredient);
        }
        return $ingredients;
    }

    public function getIngedient(int $id) {
        $ingredient = (DB::select('select * from ingredients where id = :id', ['id'=>$id]));
        return $ingredient[0] ?? null;
    }

    public function getIngedientFromUrl(string $url) {
        $ingredient = (DB::select('select * from ingredients where url = :url and active = :active', ['url'=>$url, 'active'=>1]));
        return $ingredient[0] ?? null;
    }

    public function getActiveIngredients() {
        $list = DB::select('select * from ingredients where active = :active', ['active'=>1]);
        return $list ?? null;
    }

    public function getIngredientDescription(string $url_ingredient) {
        $description = DB::select('select * from ingredient_description where url_ingredient = :name', ['name'=>$url_ingredient]);
        return $description ?? null;
    }

    //metodi per l'inserimento di dati nel database.
    public function insertIngredient(string $name, string $url, int $active) {
        $name = htmlentities($name);
        $url = htmlentities($url);
        $active = htmlentities($active);
        DB::insert('insert into ingredients (name, url, active) values (?, ?, ?)', [$name, $url, $active]);
    }

    public function insertIngredientDescription(string $url, string $description, string $image) {
        DB::insert('insert into ingredient_description (url_ingredient, description, image) values (?, ?)', [$url, $description, $image]);
    }

    //metodi per la modifica dei dati nel database.
    public function updateIngredient(string $name, string $url, int $active, int $id) {
        $name = htmlentities($name);
        $url = htmlentities($url);
        $active = htmlentities($active);
        DB::update('update ingredients set name = :name,url = :url,active = :active where id = :id', ['name'=>$name, 'url'=>$url, 'active'=>$active, 'id'=>$id]);
    }

    public function updateIngredientDescription(string $description, string $image , string $url, int $id) {
        $description = htmlentities($description);
        DB::update('update ingredients_description set description = :description, image = :image, url_ingredient = :url where id = :id', ['description'=>$description,'image'=>$image, 'url'=>$url, 'id'=>$id]);
    }

    //metodi per l'eliminazione dei dati dal databese
    public function deleteIngredient(int $id) {
        DB::delete('delete from ingredients where id = :id', ['id'=>$id]);
    }

    public function deleteIngredientDescription(int $id) {
        DB::delete('delete from ingredient_description where id = :id', ['id'=>$id]);
    }
}
