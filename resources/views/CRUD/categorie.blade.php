<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    @if(isset($name))
        Aggiungi una nuova categoria per la Macro {{$name}}
    @else
        Aggiungi una nuova categoia
    @endif
    <form>
        <label>
            Name:<input type="text" name="name" value="">
        </label>
        <label>
            Url:<input type="text" name="url" value="">
        </label>
        @if(isset($id))
            <input type="hidden" name="id_macro" value="{{$id}}">
        @endif
        <input type="submit" name="action" value="Add">

    </form>
    @if(isset($name))
        Categorie associate alla macro: {{$name}}
    @else
        Categorie
    @endif
    <ul>
    @foreach($list as $category)
        <li>
            {{$category->name}}
        </li>
        <p>
            <label>
                Name:<input type="text" name="name" value="{{$category->name}}">
            </label>
            <label>
                Url:<input type="text" name="url" value="{{$category->url}}">
            </label>
            <input type="hidden" name="macro" value="0">
            <input type="hidden" name="id_macro" value="{{$category->id}}">
            <input type="submit" name="action" value="Update">
            <input type="submit" name="action" value="delete">
            <a href="/database/ricette?id={{$category->id}}&&name={{$category->name}}">Ricette</a>
        </p>

    @endforeach
    </ul>
</body>
</html>
