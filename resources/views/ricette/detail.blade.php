@extends('template')

@section('content')
    <div class="pageContainer">
        <div class="titleContainer" style="background-image: url('{{asset('storage/images/recipes/'.$recipe->image)}}')">
            <h1 class="title">{{$recipe->name}}</h1>
            <h2 class="subtitle">{{$recipe->subheading}}</h2>
        </div>
        <div class="textContainer">
            <p class="desciption">Descrizione: {{$recipe->description}}</p>
            <div class="ingredients"> <h2>INGREDIENTI:</h2>
                <ul class="list">
                    @foreach($recipe->ingredients as $ingredient)
                        @if($ingredient->active === 1)
                            <li><a href="/ingredienti/{{$ingredient->url}}" class="button">{{$ingredient->name}}</a></li>
                        @else
                            <li>{{$ingredient->name}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="methods">
                <h2>PROCEDIMENTO:</h2>
                <ul>
                    @foreach($recipe->methods as $method)
                        <li  style="background-image: url('{{asset('storage/images/recipes/'.$method->image)}}')" class="image_method"></li>
                        <li class="method">{{$method->method}}</li>
                    @endforeach
                </ul>

            </div>

            <div> {{$recipe->final_notes}} </div>
            <div>Collegamenti a ricette e ingredienti.</div>
        </div>
        </div>



@endsection


