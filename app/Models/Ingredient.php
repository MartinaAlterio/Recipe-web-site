<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    public function Description() {

        return $this->hasMany(IngredientDescription::class, 'url_ingredient');
    }

    public function Recipes() {
        return $this->belongsToMany(Recipe::class);
    }

}
