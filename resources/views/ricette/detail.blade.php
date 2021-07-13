@extends('template')

@section('content')
    <div class="main_container main_container--detail">
        <div class="main_image" style="background-image: url('{{asset('storage/images/recipes/detail/'.$recipe->image)}}')"></div>
        <h1 class="main_title main_title--detail">{{$recipe->name}}</h1>
        <div class="border border--detail"> </div>
        <div class="main_text">
            {{$recipe->subheading}}
        </div>
        <div class="page_container">
            <div class="element element--ingredients">
                <div class="title title_reverse title--ingredients">Ingredienti</div>
                <div class="border border_reverse border--ingredients"> </div>
                <ul class="list list--ingredients">
                    @foreach($recipe->ingredients as $ingredient)
                        @if($ingredient->active === 1)
                            <li> <a href="/ingredienti/{{$ingredient->url}}">{{$ingredient->name}}</a> </li>
                        @else
                            <li>{{$ingredient->name}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="element element--methods">
                <h2 class="title title--methods">Procedimento</h2>
                <div class="border border--methods"> </div>
                <ul >
                    @foreach($recipe->methods as $method)
                        <div class="main_content">
                            <div class="main_content__text main_content__text--methods">{{$method->method}}</div>
                            @if(isset($method->image))
                            <div class="main_content__image main_content__image--methods" style="background-image: url('{{asset('storage/images/recipes/detail/'.$method->image)}}')"></div>
                            @endif
                        </div>
                    @endforeach
                </ul>
                <div class="border border--end"> </div>

            </div>
            <div>Collegamenti a ricette e ingredienti.</div>
        </div>
        </div>



@endsection


