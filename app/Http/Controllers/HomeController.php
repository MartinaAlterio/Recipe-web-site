<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;


use App\Http\classes\database\texts\HomeTextRepository;
//use http\Env\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * azione home page
     *
     * @param  HomeTextRepository  $homeTextRepository
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(HomeTextRepository $homeTextRepository, Request $request) {
        $home = new \stdClass();
        $home->title = $homeTextRepository->getContent('Titolo', 'home');
        $home->subtitle = $homeTextRepository->getContent('Sottotitolo', 'home');
        $home->recipes = $homeTextRepository->getContent('Ricette', 'home');
        $home->ingredients = $homeTextRepository->getContent('Ingredienti', 'home');
        $home->about_me = $homeTextRepository->getContent('Teresa', 'home');
        $header_transparent = true;
        $this->addFlashMessage('prova andata a buon fine', 'successo');
        return $this->render('home.index', compact('home', 'header_transparent'));
    }


}
