<?php

namespace App\Http\Classes\Database\Ingredients;

use App\Models\IngredientDescription;
use App\Models\Ingredient;
use App\Models\IngredientRecipe;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Exception;
use stdClass;

class IngredientsRepository {

    /**
     * recupero tutti gli ingredienti
     *
     * @return Collection|null
     * @throws Exception
     */
    public function getAllIngredients(): ?Collection
    {
        try {
            return Ingredient::get();
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
    //todo recuperare il quantitativo degli ingredienti (dopo aver cambiato la struttura del DB)
    public function getRecipeIngredients(int $id_recipe): Collection
    {
        try {
            return Recipe::find($id_recipe)
                                ->ingredients()
                                ->get();
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
    public function getIngredient(int $id_ingredient)
    {
        try {
            return Ingredient::where('id', $id_ingredient)
                                ->first();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero dell'ingrediente tramite id.");
        }
    }

    /**
     *recupero un determinato ingrediente tramite url
     *
     * @param  string  $url_ingredient
     * @return mixed
     * @throws Exception
     */
    public function getIngredientFromUrl(string $url_ingredient)
    {
        try {
            return Ingredient::where('active', 1)
                ->where('url', $url_ingredient)
                ->first();
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero dell'ingrediente tramite url.");
        }
    }

    /**
     *recupero gli ingredienti attivi
     *
     * @return Collection
     * @throws Exception
     */
    public function getActiveIngredients(): Collection
    {
        try {
            return Ingredient::where('active', 1)
                ->orderBy('name')
                ->get();
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nel recupero degli ingredienti attivi.");
        }
    }

    /**
     *recupero le descrizioni di un ingrediente
     *
     * @param  string  $url_ingredient
     * @return Collection|null
     * @throws Exception
     */
    public function getIngredientDescription(string $url_ingredient): ?Collection
    {
        try {
            return IngredientDescription::where('url_ingredient', $url_ingredient)
                ->get();
        } catch(Exception $e) {
            throw new Exception("Si è veririficato un errore nel recupero degli ingredienti attivi.");
        }
    }

    /**
     *inserimento ingrediente
     *
     * @param  string  $name_ingredient
     * @param  string|null  $url_ingredient
     * @param  int  $active
     * @throws Exception
     */
    public function insertIngredient(string $name_ingredient, ?string $url_ingredient, int $active) {
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
     * @param  string|null  $description_ingredient
     * @param  string|null  $image_ingredient
     * @throws Exception
     */
    public function InsertIngredientDescription(string $url_ingredient, ?string $description_ingredient, ?string $image_ingredient) {
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
     * @param  string|null  $url_ingredient
     * @param  int|null  $active
     * @param  int  $id_ingredient
     * @throws Exception
     */
    public function updateIngredient(string $name_ingredient, ?string $url_ingredient, ?int $active, int $id_ingredient) {
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
    public function updateIngredientDescription(string $description_ingredient, ?string $image_ingredient , ?string $url_ingredient, int $id_ingredient) {
        try {
            DB::update('update ingredient_description set description = :description, image = :image, url_ingredient = :url where id = :id', ['description'=>$description_ingredient,'image'=>$image_ingredient, 'url'=>$url_ingredient, 'id'=>$id_ingredient]);
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
