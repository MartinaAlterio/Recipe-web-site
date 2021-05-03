@extends('template')

@section('content')

    <div class="foto_dettaglio"> Foto ricetta
        @foreach($nome as $titolo) <p>Nome ricetta: {{$titolo->titolo}}</p>@endforeach
        <div> Ingredienti:
        @foreach($ingredienti as $ingrediente)
            @foreach($ingrediente as $nome)
                    <p>{{$nome->nome}}</p>
                @endforeach

        @endforeach
        </div>
    </div>
    <div class="descrizione-dettaglio">Descrizione e dettagli tecnici</div>
    <div>Form per le proporzioni</div>
    <div>Collegamenti a ricette e ingredienti.</div>

@endsection


