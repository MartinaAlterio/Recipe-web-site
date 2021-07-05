@extends('template')

@section('content')
    <div class="pageContainer listIngredients">
        <div>
            <p> </p>
        </div>
        <div class="textContainer">
            @foreach($list as $ingredient)
                <div class="text_image">
                    <div class="subject_reverse"><a href="/ingredienti/{{$ingredient->url}}">{{$ingredient->name}}</a></div>
                    <div class="border_reverse"></div>
                    <div class="image" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredient->image)}}')"> </div>
                    <div class="text"> </div>
                </div>
            @endforeach
        </div>
        <div>Collegamento alle ricette</div>
    </div>

@endsection


