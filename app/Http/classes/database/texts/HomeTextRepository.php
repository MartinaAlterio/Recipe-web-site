<?php


namespace App\Http\classes\database\texts;

use Illuminate\Support\Facades\DB;


class HomeTextRepository
{
    /**
     * recupero contenuti pagine
     *
     * @param  string  $section
     * @param  string  $page
     * @return mixed|null
     */
    public function getContent(string $section, string $page) {
        try {
            $content = DB::select('select content, image from page_contents where section = :section and page =:page', ['section'=>$section, 'page'=>$page]);
        } catch(Exception $e) {

        }
        return $content[0] ?? null;
    }
}
