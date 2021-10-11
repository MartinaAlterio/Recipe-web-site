<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function active() {
        return $this->where('active', 1)
                    ->orderBy('name')
                    ->get();
    }

    public function getActiveByUrl(string $url) {
        return $this->where('active', 1)
                    ->where('url', $url)
                    ->get()
                    ->first();
    }
}
