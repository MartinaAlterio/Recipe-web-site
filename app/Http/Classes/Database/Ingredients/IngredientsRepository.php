<?php

namespace App\Http\Classes\Database\Ingredients;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Exceptions\MyExceptions;

class IngredientsRepository {

    /**
     * recupero tutti gli ingredienti
     *
     * @return array
     * @throws Exception
     */
    public function getAllIngredients(): array {
        try {
            $ingredients = DB::select('select * from ingredients');
            return $ingredients;
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero degli ingredienti.");
        }
    }

    /**
     * recupero ingredienti di una ricetta
     *
     * @param  int  $id_recipe
     * @return array
     * @throws Exception
     */
    public function getRecipeIngredients(int $id_recipe): array {
        try {
            $list = DB::select('select id_ingredient from recipe_has_ingredients where id_recipe = :id', ['id'=>$id_recipe]);
            $ingredients = [];
            foreach ($list as $value) {
                $ingredients[] = $this->getIngredient($value->id_ingredient);
            }
            return $ingredients;
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero degli ingredienti della ricetta.");
        }
    }

    /**
     *recupero un determinato ingrediente tramite id
     *
     * @param  int  $id_ingredient
     * @return mixed|null
     * @throws Exception
     */
    public function getIngredient(int $id_ingredient): mixed
    {
        try {
            $ingredient = (DB::select('select * from ingredients where id = :id', ['id'=>$id_ingredient]));
            return $ingredient[0] ?? null;
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero dell'ingrediente tramite id.");
        }
    }

    /**
     *recupero un determinato ingrediente tramite url
     *
     * @param  string  $url_ingredient
     * @return mixed|null
     * @throws Exception
     */
    public function getIngredientFromUrl(string $url_ingredient): mixed
    {
        try {
            $ingredient = (DB::select('select * from ingredients where url = :url and active = :active', ['url'=>$url_ingredient, 'active'=>1]));
            return $ingredient[0] ?? null;
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero dell'ingrediente tramite url.");
        }
    }

    /**
     *recupero gli ingredienti attivi
     *
     * @return array|null
     * @throws Exception
     */
    public function getActiveIngredients(): ?array
    {
        try {
            $list = DB::select('select * from ingredients where active = :active', ['active'=>1]);
            return $list ?? null;
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nel recupero degli ingredienti attivi.");
        }
    }

    /**
     *recupero le descrizioni di un ingrediente
     *
     * @param  string  $url_ingredient
     * @return array|null
     * @throws Exception
     */
    public function getIngredientDescription(string $url_ingredient): ?array
    {
        try {
            $description = DB::select('select * from ingredient_description where url_ingredient = :name', ['name'=>$url_ingredient]);
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nel recupero degli ingredienti attivi.");
        }
        return $description ?? null;
    }

    /**
     *inserimento ingrediente
     *
     * @param  string  $name_ingredient
     * @param  string  $url_ingredient
     * @param  int  $active
     * @throws Exception
     */
    public function insertIngredient(string $name_ingredient, string $url_ingredient, int $active) {
        try {
            DB::insert('insert into ingredients (name, url, active) values (?, ?, ?)', [$name_ingredient, $url_ingredient, $active]);
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nell'inserimento dell'ingrediente.");
        }
    }

    /**
     *inserimento descrizione ingrediente attivo
     *
     * @param  string  $url_ingredient
     * @param  string  $description_ingredient
     * @param  string  $image_ingredient
     * @throws Exception
     */
    public function InsertIngredientDescription(string $url_ingredient, string $description_ingredient, string $image_ingredient) {
        try {
            DB::insert('insert into ingredient_description (url_ingredient, description, image) values (?, ?,?)', [$url_ingredient, $description_ingredient, $image_ingredient]);
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nell'inserimento del dettaglio dell'ingrediente.");
        }
        }

    /**
     * modifica ingrediente
     *
     * @param  string  $name_ingredient
     * @param  string  $url_ingredient
     * @param  int  $active
     * @param  int  $id_ingredient
     * @throws Exception
     */
    public function updateIngredient(string $name_ingredient, string $url_ingredient, int $active, int $id_ingredient) {
        try {
            DB::update('update ingredients set name = :name,url = :url,active = :active where id = :id', ['name'=>$name_ingredient, 'url'=>$url_ingredient, 'active'=>$active, 'id'=>$id_ingredient]);
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nella modifica dell'ingrediente.");
        }
    }

    /**
     *modifica descrizione ingrediente attivo
     *
     * @param  string  $description_ingredient
     * @param  string  $image_ingredient
     * @param  string  $url_ingredient
     * @param  int  $id_ingredient
     * @throws Exception
     */
    public function updateIngredientDescription(string $description_ingredient, string $image_ingredient , string $url_ingredient, int $id_ingredient) {
        try {
            DB::update('update ingredients_description set description = :description, image = :image, url_ingredient = :url where id = :id', ['description'=>$description_ingredient,'image'=>$image_ingredient, 'url'=>$url_ingredient, 'id'=>$id_ingredient]);
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nella modifica della descrizione dell'ingredeinte.");
        }
    }

    /**
     * cancellazione ingrediente
     *
     * @param  int  $id_ingredient
     * @throws Exception
     */
    public function deleteIngredient(int $id_ingredient) {
        try {
            DB::delete('delete from ingredients where id = :id', ['id'=>$id_ingredient]);
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nella cancellazione dell'ingrediente.");
        }
    }

    /**
     * cancellazione descrizione ingrediente attivo
     *
     * @param  int  $id_ingredient
     * @throws Exception
     */
    public function deleteIngredientDescription(int $id_ingredient) {
        try {
            DB::delete('delete from ingredient_description where id = :id', ['id'=>$id_ingredient]);
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nella rimozione della descrizione dell'ingrediente.");
        }
    }
}
