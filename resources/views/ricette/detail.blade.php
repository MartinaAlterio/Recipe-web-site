
@extends('template')

@section('content')
    <div class="main_container main_container--detail">
        <div class="main_image main_image--detail" style="background-image: url('{{asset('storage/images/recipes/detail/'.$recipe->image)}}')"></div>
        <h1 class="main_title main_title--detail">{{$recipe->name}}</h1>
        <div class="border border--detail"> </div>
        <div class="main_text main_text--detail">
            {{$recipe->subheading}}
        </div>
        <div class="page_container page_container--Detailingredients">
            <div class="element element--Detailingredients">
                <div class="title title_reverse title--Detailingredients">Ingredienti</div>
                <div class="border border_reverse border--Detailingredients"> </div>
                <ul class="list list--Detailingredients">
                    @foreach($recipe->ingredients as $ingredient)
                        @if($ingredient->active === 1)
                            <li> <a href="/ingredienti/{{$ingredient->url}}">{{$ingredient->name}} </a> : {{$ingredient->pivot->quantity}} </li>
                        @else
                            <li>{{$ingredient->name}} : {{$ingredient->pivot->quantity}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="element element--methods">
                <h2 class="title title--methods">Procedimento</h2>
                <div class="border border--methods"> </div>
                <ul >
                    @foreach($recipe->methods??[] as $method)
                        <div class="main_content main_content--detail">
                            <div class="main_content__text main_content__text--methods">{{$method->method}}</div>
                            @if(isset($method->image))
                            <div class="main_content__image main_content__image--methods" style="background-image: url('{{asset('storage/images/recipes/detail/methods/'.$method->image)}}')"></div>
                            @endif
                        </div>
                    @endforeach
                </ul>
                @if(!empty($recipe->linked_recipes))
                    <div class="border border--end"> </div>
                    <p class="title title--linked_recipe">Scopri altre ricette simili...</p>
                    <ul class="container_list container_list--category">
                        @foreach($recipe->linked_recipes as $linked_recipe)
                            <a href="/ricette/{{$linked_recipe->linked_category_url}}/{{$linked_recipe->url}}">
                                <div class="list_element list_element--category">
                                    <div class="list__image list__image--category" style="background-image: url('{{asset('storage/images/recipes/detail/'.$linked_recipe->image)}}')"></div>
                                    <div class="list__title list__title--category">{{strtoupper($linked_recipe->name)}}</div>
                                </div>
                            </a>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

@endsection


