<?php


namespace App\Http\classes\database\texts;

use Illuminate\Support\Facades\DB;


class HomeTextRepository
{
    public function getContent(string $section, string $page) {
        $content = DB::select('select content, image from page_contents where section = :section and page =:page', ['section'=>$section, 'page'=>$page]);
        return $content[0] ?? null;
    }
}
