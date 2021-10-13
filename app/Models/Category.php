<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function category() {
        return $this->belongsToMany(Category::class, 'category_category', 'macrocategory_id', 'category_id');
    }

    public function recipe() {
        return $this->belongsToMany(Recipe::class);
    }

    public $timestamps = false;
}
