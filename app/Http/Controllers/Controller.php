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

    protected function render(string $view, array $variables) {
        $messages = session('messages');
        $variables['messages'] = $messages;
        return view($view, $variables);
    }

    public function addFlashMessage(string $messages,  string $type) {
        session(['messages'=>$messages, 'type'=>$type]);
    }
}
