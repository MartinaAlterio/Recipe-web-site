<?php

namespace App\Http\Controllers;

use App\Models\HomeContent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Classes\Database\Texts\HomeTextRepository;
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
        $header_transparent = true;
        $home = new HomeContent();
        try {
            $home->setTitle($homeTextRepository->getContent('Titolo', 'home'));
            $home->setSubtitle($homeTextRepository->getContent('Sottotitolo', 'home'));
            $home->setRecipes($homeTextRepository->getContent('Ricette', 'home'));
            $home->setIngredients($homeTextRepository->getContent('Ingredienti', 'home'));
            $home->setAboutMe($homeTextRepository->getContent('Teresa', 'home'));
        } catch (Exception $e) {
            $this->addFlashMessage("Non è stato possibile recuperare i contenuti della home", "error");
        }
        return $this->render('home.index', compact('home', 'header_transparent'));
    }
}
