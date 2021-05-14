@extends('template')

@section('content')

    <div class="foto_dettaglio">Foto ingrediente
        <h1>Ingrediente : {{$ingredient->name}}</h1>
    </div>
    <div>
        @foreach($ingredient->description as $description)
            <p>{{$description->description}}</p>
        @endforeach
    </div>

@endsection
