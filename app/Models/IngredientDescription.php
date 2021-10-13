<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientDescription extends Model
{
    public static function activeDescription(string $url) {
        return IngredientDescription::where('url_ingredient', $url)
                    ->get();
    }

    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }

    public $timestamps = false;
}
