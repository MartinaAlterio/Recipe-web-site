<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div>Seleziona le categorie per la macro [{{$macro->name}}]</div>

    <form method="post">
        @foreach($categories as $category)
            @if($category->id !== $macro->id && $category->macro !== 1)
                @if(in_array($category->id, $id_categories))
                    <input type="checkbox" name="id[]" value="{{$category->id}}" checked>

                @else
                    <input type="checkbox" name="id[]" value="{{$category->id}}">
                @endif
                <label>{{$category->name}}</label><br>
            @endif
        @endforeach
        <input type="hidden" name="id_macro" value="{{$macro->id}}">
        <input type="hidden" name="url" value="{{$macro->url}}">
        <input type="submit" name="action" value="insert">
        @csrf
    </form>
</body>
</html>
