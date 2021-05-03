<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class QueryRicetteController extends Controller
{
    public function index() {
        $ingredienti = DB::select('select nome from ingredienti where id in(select id_ingrediente from ricetta_ingrediente where id_ricetta = 1)');
        foreach ($ingredienti as $value) {
            echo($value->nome);
        }
    }
}
