<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $messages = [];
    protected $message= [];
    /**
     * aggiunge flash message in sessione
     *
     * @param  string  $text
     * @param  string  $type
     */
    public function addFlashMessage(string $text,  string $type) {
        $this->message['text']= $text;
        $this->message['type'] = $type;
        $this->messages[]= $this->message;
        session(['messages' => $this->messages]);
    }

    /**
     *funzione utilizzata per effettuare operazione prima di ritornare la view
     *
     * @param  string  $view
     * @param  array  $variables
     * @return Application|Factory|View
     */
    protected function render(string $view, array $variables) {
        $messages = session()->pull('messages');
        $variables['messages'] = $messages;
        return view($view, $variables);
    }
}
