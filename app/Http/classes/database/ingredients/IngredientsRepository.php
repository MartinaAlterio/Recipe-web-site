<?php


namespace App\Http\classes\database\ingredients;

use App\Http\classes\database\Recipes\RecipesRepository;
use Illuminate\Support\Facades\DB;


class IngredientsRepository
{

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
        $ingredient = (DB::select('select * from ingredients where url = :url', ['url'=>$url]));
        return $ingredient[0] ?? null;
    }

    public function getActiveIngredients() {
        $list = DB::select('select * from ingredients where active = :active', ['active'=>1]);
        return $list ?? null;
    }

    public function getIngredientDescription(int $id_ingredient) {
        $description = DB::select('select * from ingredient_description where id_ingredient = :id', ['id'=>$id_ingredient]);
        return $description ?? null;
    }

}
