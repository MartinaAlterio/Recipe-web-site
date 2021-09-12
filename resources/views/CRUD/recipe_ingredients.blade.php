@extends('templateDatabase')

@section('content')

    <div>Seleziona gli ingredienti per la ricetta [{{$recipe->name}}]</div>

    <form method="post">
        @foreach($ingredients as $ingredient)
            <div class="element">
                <input type="checkbox" name="ingredients[{{$ingredient->id}}][checked]" value="{{$ingredient->id}}" {{isset($recipe_ingredients[$ingredient->id]) ? "checked" : ""}}>
                <p>{{$ingredient->name}}</p>
                <label for="quantity" class="quantity">Quantità:
                    <input type="text" name="ingredients[{{$ingredient->id}}][quantity]" value="{{$recipe_ingredients[$ingredient->id]['quantity'] ?? ""}}">
                </label><br>
            </div>
        @endforeach
        <input type="hidden" name="id_recipe" value="{{$recipe->id}}">
        <input type="hidden" name="url" value="{{$recipe->url}}">
        <input type="submit" name="action" value="insert">
        @csrf
    </form>

@endsection
