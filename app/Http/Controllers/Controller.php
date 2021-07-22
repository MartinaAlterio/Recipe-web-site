<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * aggiunge flash message in sessione
     *
     * @param  string  $messages
     * @param  string  $type
     */
    public function addFlashMessage(string $messages,  string $type) {
        session(['messages'=>$messages, 'type'=>$type]);
    }

    /**
     *funzione utilizzata per effettuare operazione prima di ritornare la view
     *
     * @param  string  $view
     * @param  array  $variables
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function render(string $view, array $variables) {
        $messages = session('messages');
        $variables['messages'] = $messages;
        return view($view, $variables);
    }
}
