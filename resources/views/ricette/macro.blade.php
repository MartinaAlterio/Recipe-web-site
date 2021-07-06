@extends('template')

@section('content')
    <div class="main_container">
        <div class="page_container">
            @if(isset($macros))
                <ul>
                    @foreach($macros as $value)
                        <div class="main_content main_content--macro">
                            <div class="main_content__image" style="background-image: url('{{asset('storage/images/recipes/macro/'.$value->image->image)}}')">
                                <div class="title title--macro">{{$value->name}}</div>
                            </div>
                            <div class="container_list container_list--macro">
                                <div class="list list--macro">
                                    @foreach($value->categories as $value)
                                        <div class="list__element">
                                        <!--<div class="list_recipes">
                                         @foreach($value->recipes as $recipe)
                                            <li class="recipe"><a href="/ricette/{{$value->url}}/{{$recipe->url}}">{{$recipe->name}}</a></li>
                                                <div class="image"> </div> style="background-image: url('{{asset('storage/images/recipes/'.$recipe->image)}}')"
                                            @endforeach
                                            </div>-->
                                            <div class="list__title"><a href="/ricette/{{$value->url}}">{{$value->name}}</a></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection


