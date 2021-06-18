@extends('template')

@section('content')
    <div class="pageContainer">
        <div class="titleContainer" style="background-image: url('{{asset('storage/images/recipes/'.$recipe->image)}}')">
            <h1 class="title">{{$recipe->name}}</h1>
            <!--<h2 class="subtitle">{{$recipe->subheading}}</h2>-->
        </div>
        <div class="textContainer">
            <h2 class="subject"> Descrizione</h2>
            <div class="description">
                {{$recipe->description}}
            </div>
            <div class="ingredients">
                <div class="subject">Ingredienti</div>
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
            <div>
                <h2 class="subject">Procedimento</h2>
                <ul>
                    @foreach($recipe->methods as $method)
                        <li class="text_image">
                            <div class="text_method">{{$method->method}}</div>
                            <div class="image_method" style="background-image: url('{{asset('storage/images/recipes/'.$method->image)}}')"></div>
                        </li>
                    @endforeach
                </ul>

            </div>

            <div> {{$recipe->final_notes}} </div>
            <div>Collegamenti a ricette e ingredienti.</div>
        </div>
        </div>



@endsection


