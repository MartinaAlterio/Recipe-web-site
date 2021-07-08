@extends('template')

@section('content')
    <div class="main_container">
        <div class="page_container">
            @if(isset($macros))
                <ul>
                    @foreach($macros as $macro)
                        <div class="main_content main_content--macro">
                            <div class="main_content__image" style="background-image: url('{{asset('storage/images/recipes/macro/'.$macro->image->image)}}')">
                                <div class="title title--macro">{{$macro->name}}</div>
                            </div>
                            <div class="container_list container_list--macro">
                                <div class="list list--macro">
                                    @foreach($macro->categories as $category)
                                        <div class="list__element">
                                        <!--<div class="list_recipes">
                                         @foreach($category->recipes as $recipe)
                                            <li class="recipe"><a href="/ricette/{{$category->url}}/{{$recipe->url}}">{{$recipe->name}}</a></li>
                                                <div class="image"> </div> style="background-image: url('{{asset('storage/images/recipes/'.$recipe->image)}}')"
                                            @endforeach
                                            </div>-->
                                            <div class="list__title"><a href="/ricette/{{$category->url}}">{{$category->name}}</a></div>
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


