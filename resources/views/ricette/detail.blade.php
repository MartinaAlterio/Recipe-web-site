@extends('template')

@section('content')
    <div class="pageContainer recipeDetail">
        <div class="titleContainer" style="background-image: url('{{asset('storage/images/recipes/detail/'.$recipe->image)}}')">
            <h1 class="title">{{$recipe->name}}</h1>
            <!--<h2 class="subtitle">{{$recipe->subheading}}</h2>-->
        </div>
        <div class="textContainer">
            <h2 class="subject"> Descrizione</h2>
            <div class="border"> </div>
            <div class="description">
                {{$recipe->description}}
            </div>
            <div class="ingredients">
                <div class="subject subject_reverse">Ingredienti</div>
                <div class="border border_reverse"> </div>
                <ul class="list">
                    @foreach($recipe->ingredients as $ingredient)
                        @if($ingredient->active === 1)
                            <li> <a href="/ingredienti/{{$ingredient->url}}">{{$ingredient->name}}</a> </li>
                        @else
                            <li>{{$ingredient->name}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="method">
                <h2 class="subject">Procedimento</h2>
                <div class="border"> </div>
                <ul>
                    @foreach($recipe->methods as $method)
                        <li class="text_image">
                            <div class="text_method">{{$method->method}}</div>
                            @if(isset($method->image))
                            <div class="image_method" style="background-image: url('{{asset('storage/images/recipes/detail/'.$method->image)}}')"></div>
                                @endif
                        </li>
                    @endforeach
                </ul>
                <div class="border-end"> </div>

            </div>

            <div> {{$recipe->final_notes}} </div>
            <div>Collegamenti a ricette e ingredienti.</div>
        </div>
        </div>



@endsection


