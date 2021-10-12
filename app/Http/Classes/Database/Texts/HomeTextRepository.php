<?php


namespace App\Http\Classes\Database\Texts;

use App\Models\PageContent;
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
            $content = PageContent::where('page', $page)
                                ->where('section', $section)
                                ->first();
            return [
                'content' => $content->content ?? null,
                'image' => $content->image ?? null
            ];
        } catch(Exception $e) {
            throw new Exception("Si è verificato un errore nel recupero dei contenuti della home.");
        }
    }
}
