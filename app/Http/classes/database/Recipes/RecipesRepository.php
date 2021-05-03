<?php


namespace App\Http\classes\database\Recipes;

use Illuminate\Support\Facades\DB;


class RecipesRepository
{

    public function getListMacro() {
        $list = (DB::select('Select * from categories where macro = :macro', ['macro'=>true]));
        return $list ?? null;
    }

    public function getCategoriesMacro(int $id) {
        $list = (DB::select('select id_category from category_has_categories where id_macrocategory = :id', ['id'=>$id]));
        $category = [];
        foreach ($list as $value) {
            $category[] = $this->getCategory($value->id_category);
        }
        return $category;
    }

    public function getCategoryFromUrl(string $url) {
        $category = DB::select('Select * from categories where url = :url', ['url'=>$url]);
        return $category[0] ?? null;
    }

    public function getCategory(int $id) {
        $category = (DB::select('select * from categories where id = :id', ['id'=>$id]));
        return $category[0] ?? null;
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

    //recupea le ricette Importanti associate ad una singola categoria.
    public function getImportantRecipesCategory(int $id_category) {
        $list = DB::select('select rc.id_recipe from recipe_has_categories as rc join recipes as r on r.id = rc.id_recipe where r.important = :important and rc.id_category = :id', ['important'=>1 ,'id'=>$id_category]);
        $recipes = [];
        foreach ($list as $value) {
            $recipes[] = $this->getRecipe($value->id_recipe);
        }
        return $recipes;
    }

    public function  getRecipeMethods (int $id_recipe) {
        $methods = DB::select('select * from methods where id_recipe = :id', ['id'=>$id_recipe]);
        return $methods;
    }

}
