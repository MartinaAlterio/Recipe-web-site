<?php


namespace App\Http\Classes\Database\Texts;

use Illuminate\Support\Facades\DB;
use Exception;


class HomeTextRepository
{
    /**
     * recupero contenuti pagine
     *
     * @param  string  $section
     * @param  string  $page
     * @return array
     * @throws Exception
     */
    public function getContent(string $section, string $page): array {
        try {
            $content = DB::select('select content, image from page_contents where section = :section and page =:page', ['section'=>$section, 'page'=>$page]);
            return [
                'content' => $content[0]->content ?? null,
                'image' => $content[0]->image ?? null
            ];
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero dei contenuti della home.");
        }
    }
}
