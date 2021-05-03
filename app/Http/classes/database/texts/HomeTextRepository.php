<?php


namespace App\Http\classes\database\texts;

use Illuminate\Support\Facades\DB;


class HomeTextRepository
{
    public function getTitle(string $section) {
        $title = DB::select('select content from home_contents where section = :section', ['section'=>$section]);
        return $title[0]->content ?? null;
    }

    public function getSubtitle(string $section) {
        $subtitle = DB::select('select content from home_contents where section = :section', ['section'=>$section]);
        return $subtitle[0]->content ?? null;

    }

    public function getRecipeText(string $section) {
        $recipe_text = DB::select('select content from home_contents where section = :section', ['section'=>$section]);
        return $recipe_text[0]->content ?? null;
    }

    public function getIngredientsText(string $section) {
        $ingredients_text = DB::select('select content from home_contents where section = :section', ['section'=>$section]);
        return $ingredients_text[0]->content ?? null;
    }

    public function getAboutMeText(string $section) {
        $about_me = DB::select('select content from home_contents where section = :section', ['section'=>$section]);
        return $about_me[0]->content ?? null;
    }
}
