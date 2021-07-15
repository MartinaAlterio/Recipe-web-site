<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div>Seleziona le ricette collegate a [{{$main_recipe->name}}]</div>
    <br>
    <div>
        <form method="post">
            @foreach($recipes as $recipe)
                @if($recipe->id !== $main_recipe->id)
                    @if(in_array($recipe->id, $linked_recipes_id))
                        <input type="checkbox" name="id[]" value="{{$recipe->id}}" checked>
                    @else
                        <input type="checkbox" name="id[]" value="{{$recipe->id}}">
                    @endif
                    <label>{{$recipe->name}}</label><br>
                @endif
            @endforeach
            <br>
            <input type="hidden" name="id_recipe" value="{{$main_recipe->id}}">
            <input type="hidden" name="url" value="{{$main_recipe->url}}">
            <input type="submit" name="action" value="insert">
            @csrf
        </form>
    </div>
</body>
</html>
