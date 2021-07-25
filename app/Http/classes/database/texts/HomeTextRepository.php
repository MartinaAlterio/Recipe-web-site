<?php


namespace App\Http\classes\database\texts;

use Illuminate\Support\Facades\DB;
use Exception;


class HomeTextRepository
{
    /**
     * recupero contenuti pagine
     *
     * @param  string  $section
     * @param  string  $page
     * @return mixed|null
     * @throws Exception
     */
    public function getContent(string $section, string $page) {
        try {
            $content = DB::select('select content, image from page_contents where section = :section and page =:page', ['section'=>$section, 'page'=>$page]);
            return $content[0] ?? null;
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero dei contenuti della home.");
        }
    }
}
