<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeMethod extends Model
{

    public function recipe() {

        return $this->belongsTo(Recipe::class);
    }

    public $timestamps = false;
}
