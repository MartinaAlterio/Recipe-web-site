@extends('template')

@section('content')
    <div class="pageContainer">
        <div class="textContainer macroText">
            @if(isset($macros))
                <ul class="macroContainer">
                    @foreach($macros as $value)
                        <div class="macro">
                            <div class="text_macro">
                                <li class="subject">{{$value->name}}</li>
                                <div class="border"></div>
                                <div class="list_macro">
                                    @foreach($value->categories as $value)
                                        <li><a href="/ricette/{{$value->url}}">{{$value->name}}</a></li>
                                        <div class="list_recipes">
                                            @foreach($value->recipes as $recipe)
                                                <li><a href="/ricette/{{$value->url}}/{{$recipe->url}}">{{$recipe->name}}</a></li>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="image_macro"> </div>
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection


