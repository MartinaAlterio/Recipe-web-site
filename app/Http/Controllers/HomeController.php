<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;

use App\Http\classes\database\texts\HomeTextRepository;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(HomeTextRepository $homeTextRepository) {
        $home = new \stdClass();
        $home->title = $homeTextRepository->getTitle('Titolo');
        $home->subtitle = $homeTextRepository->getSubtitle('Sottotitolo');
        $home->recipes = $homeTextRepository->getIngredientsText('Ricette');
        $home->ingredients = $homeTextRepository->getIngredientsText('Ingredienti');
        $home->about_me = $homeTextRepository->getAboutMeText('Teresa');
        echo"<pre>";
        var_dump($home);

    }
}
