@extends('template')

@section('content')
    <div class="pageContainer">
        <div class="textContainer macroText">
            @if(isset($macros))
                <ul>
                    @foreach($macros as $value)
                        <div class="macro">
                                <li class="subject subject_reverse">{{$value->name}}</li>
                                <div class="border border_reverse"></div>
                                <div class="list_macro">
                                    @foreach($value->categories as $value)
                                        <div class="macro_recipe">
                                            <li class="name_macro"><a href="/ricette/{{$value->url}}">{{$value->name}}</a></li>
                                            <div class="image_macro"> </div>
                                            <div class="list_recipes">
                                                @foreach($value->recipes as $recipe)
                                                    <li class="recipe"><a href="/ricette/{{$value->url}}/{{$recipe->url}}">{{$recipe->name}}</a></li>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection


