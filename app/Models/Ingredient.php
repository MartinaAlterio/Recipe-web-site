<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public static function active() {
        return Ingredient::where('active', 1)
                    ->orderBy('name')
                    ->get();
    }

    public static function getActiveByUrl(string $url) {
        return Ingredient::where('active', 1)
                    ->where('url', $url)
                    ->first();
    }

    public function Description() {

        return $this->hasMany(IngredientDescription::class, 'url_ingredient');
    }

}
