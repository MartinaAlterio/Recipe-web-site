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
        $home->title = $homeTextRepository->getContent('Titolo', 'home');
        $home->subtitle = $homeTextRepository->getContent('Sottotitolo', 'home');
        $home->recipes = $homeTextRepository->getContent('Ricette', 'home');
        $home->ingredients = $homeTextRepository->getContent('Ingredienti', 'home');
        $home->about_me = $homeTextRepository->getContent('Teresa', 'home');
        return view('home.index', compact('home'));
    }
}
