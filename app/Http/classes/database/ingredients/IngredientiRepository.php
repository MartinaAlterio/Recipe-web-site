<?php


namespace App\Http\classes\database\ingredients;

use App\Http\classes\database\Recipes\RicetteRepository;
use Illuminate\Support\Facades\DB;


class IngredientiRepository
{

    public function getRecipe(int $id){
        $recipe = DB::select('select * from recipes where id = :id', ['id'=>$id]);
        return $recipe[0] ?? null;
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

}
