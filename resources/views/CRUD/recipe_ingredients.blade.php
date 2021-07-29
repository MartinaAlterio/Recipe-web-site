@extends('templateDatabase')

@section('content')

    <div>Seleziona gli ingredienti per la ricetta [{{$recipe->name}}]</div>

    <form method="post">
        @foreach($ingredients as $ingredient)
            @if(in_array($ingredient->id, $id_ingredients))
                <input type="checkbox" name="id[]" value="{{$ingredient->id}}" checked>

            @else
                <input type="checkbox" name="id[]" value="{{$ingredient->id}}">
            @endif
            <p>{{$ingredient->name}}</p><br>
        @endforeach
            <input type="hidden" name="id_recipe" value="{{$recipe->id}}">
            <input type="hidden" name="url" value="{{$recipe->url}}">
            <input type="submit" name="action" value="insert">
            @csrf
    </form>

@endsection
