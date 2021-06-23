@extends('template')

@section('content')
    <div class="pageContainer">
        <div class="textContainer macroText">
            @if(isset($macros))
                <ul>
                    @foreach($macros as $value)
                        <div class="macro">
                            <div class="titleContainer TCmacro" style="background-image: url('{{asset('storage/images/recipes/'.$value->image->image)}}')">
                                <li class="title title_macro">{{$value->name}}</li>
                            </div>
                            <div class="list_macro">
                                @foreach($value->categories as $value)
                                    <div class="macro_recipe">
                                    <!--<div class="list_recipes">
                                         @foreach($value->recipes as $recipe)
                                                <li class="recipe"><a href="/ricette/{{$value->url}}/{{$recipe->url}}">{{$recipe->name}}</a></li>
                                                <div class="image"> </div> style="background-image: url('{{asset('storage/images/recipes/'.$recipe->image)}}')"
                                            @endforeach
                                        </div>-->
                                        <li class="subject s_macro"><a href="/ricette/{{$value->url}}">{{$value->name}}</a></li>
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


