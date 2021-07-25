<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\classes\database\texts\HomeTextRepository;
use Exception;

class HomeController extends Controller
{

    /**
     * azione home page
     *
     * @param  HomeTextRepository  $homeTextRepository
     * @return Application|Factory|View
     */
    public function index(HomeTextRepository $homeTextRepository) {
        try {
            $home = new \stdClass();
            $home->title = $homeTextRepository->getContent('Titolo', 'home');
            $home->subtitle = $homeTextRepository->getContent('Sottotitolo', 'home');
            $home->recipes = $homeTextRepository->getContent('Ricette', 'home');
            $home->ingredients = $homeTextRepository->getContent('Ingredienti', 'home');
            $home->about_me = $homeTextRepository->getContent('Teresa', 'home');
            $header_transparent = true;
        } catch (Exception $e) {

        }
        return $this->render('home.index', compact('home', 'header_transparent'));
    }
}
