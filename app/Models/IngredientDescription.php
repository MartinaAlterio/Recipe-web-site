<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientDescription extends Model
{
    public function activeDescription(string $url) {
        return $this->where('url_ingredient', $url)
                    ->get();
    }
}
