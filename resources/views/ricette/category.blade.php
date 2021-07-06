@extends('template')

@section('content')
    <div class="main_conteiner main_container--category">
        <div class="main_title main_title--category">{{$category->name}}</div>
        <div class="border border--category"></div>
        <div class="main_image" style="background-image: url('{{asset('storage/images/recipes/category/'.$category->image)}}')"></div>
        <div class="main_text"> {{$category->description}}</div>
        <div class="page_container page_container--category">
            <ul class="container_list container_list--category">
                @foreach($category->recipes as $recipe)
                    <div class="list_element list_element--category">
                        <div class="list__image list__image--category" style="background-image: url('{{asset('storage/images/recipes/detail/'.$recipe->image)}}')"></div>
                        <div class="list__title list__title--category"><a href="/ricette/{{$category->url}}/{{$recipe->url}}">{{strtoupper($recipe->name)}}</a></div>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
