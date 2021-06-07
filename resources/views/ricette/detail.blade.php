@extends('template')

@section('content')
    <div class="titleContainer" style="background-image: url('{{asset('storage/images/recipes/'.$recipe->image)}}')">
       <h1 class="title">{{$recipe->name}}</h1>
       <p>Sottotitolo: {{$recipe->subheading}}</p>
    </div>
    <p>Descrizione: {{$recipe->description}}</p>
    <div> Ingredienti:
        <ul>
            @foreach($recipe->ingredients as $ingredient)
                @if($ingredient->active === 1)
                    <li><a href="/ingredienti/{{$ingredient->url}}" class="button">{{$ingredient->name}}</a></li>
                @else
                    <li>{{$ingredient->name}}</li>
                @endif
            @endforeach
        </ul>
    </div>
    <div>
        <h4>Procedimento</h4>
        <ul>
            @foreach($recipe->methods as $method)
                <li>{{$method->method}}</li>
            @endforeach
        </ul>

    </div>

    <div> {{$recipe->final_notes}} </div>
    <div>Collegamenti a ricette e ingredienti.</div>


@endsection


