<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

    <div>Seleziona gli ingredienti per la ricetta [{{$recipe->name}}]</div>

    <form method="post">
        @foreach($ingredients as $ingredient)
            @if(in_array($ingredient->id, $id_ingredients))
                <input type="checkbox" name="id[]" value="{{$ingredient->id}}" checked>

            @else
                <input type="checkbox" name="id[]" value="{{$ingredient->id}}">
            @endif
            <label>{{$ingredient->name}}</label><br>
        @endforeach
            <input type="hidden" name="id_recipe" value="{{$recipe->id}}">
            <input type="submit" name="action" value="insert">
            @csrf
    </form>
</body>
</html>
