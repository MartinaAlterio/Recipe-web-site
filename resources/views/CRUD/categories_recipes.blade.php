<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div>Seleziona le ricette per la categoria [{{$category->name}}]</div>

    <form method="post">
    @foreach($recipes as $recipe)
        @if(in_array($recipe->id, $id_recipes))
            <input type="checkbox" name="id[]" value="{{$recipe->id}}" checked>

        @else
            <input type="checkbox" name="id[]" value="{{$recipe->id}}">
        @endif
        <label>{{$recipe->name}}</label><br>
    @endforeach
    <input type="hidden" name="id_category" value="{{$category->id}}">
    <input type="hidden" name="url" value="{{$category->url}}">
    <input type="submit" name="action" value="insert">
    @csrf
    </form>
</body>
</html>
