@extends('template')

@section('content')
    <div> <h1>Lista completa degli ingredienti trattati.</h1> </div>
    <div>CONTAINTER IMMAGINI+ DESCRIZIONI
        @foreach($list as $ingredient)
            <div><a href="/ingredienti/{{$ingredient->url}}">{{$ingredient->name}}</a> + foto</div>
        @endforeach
    </div>
    <div>Collegamento alle ricette</div>
@endsection


