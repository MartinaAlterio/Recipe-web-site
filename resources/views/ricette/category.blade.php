@extends('template')

@section('content')
    <div class="pageContainer">
        <div class="subject">{{$category->name}}</div>
        <div class="border"></div>
        <div class="textContainer imageContainer">
            <div class="main_image"></div>
            <div class="description category_description"> {{$category->description}}</div>
            <ul class="recipe_container">
                @foreach($category->recipes as $recipe)
                    <div class="image_title">
                        <div class="image_recipe" style="background-image: url('{{asset('storage/images/recipes/'.$recipe->image)}}')"></div>
                        <li class="button"><a href="/ricette/{{$category->url}}/{{$recipe->url}}">{{$recipe->name}}</a></li>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
