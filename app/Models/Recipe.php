<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    public function methods() {

        return $this->hasMany(RecipeMethod::class);
    }

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
    }

    public function category() {
        return $this->belongsToMany(Category::class);
    }

    public function recipe() {
        return $this->belongsToMany(Recipe::class, 'recipe_recipe', 'recipe_id', 'linked_recipe_id' );
    }

    public $timestamps = false;
}
