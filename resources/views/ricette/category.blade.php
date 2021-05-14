@extends('template')

@section('content')

    {{$category->name}}
    <ul>
        @foreach($category->recipes as $recipe)
            <li><a href="/ricette/{{$category->url}}/{{$recipe->url}}">{{$recipe->name}}</a></li>
        @endforeach
    </ul>


@endsection
