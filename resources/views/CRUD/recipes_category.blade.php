<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    @if(isset($name))
        Aggiungi una nuova ricetta per la categoria {{$name}}
    @else
        Aggiungi una nuova Ricetta
    @endif
    <form>
        <label>
            Name:<input type="text" name="name" value="">
        </label>
        <label>
            Url:<input type="text" name="url" value="">
        </label>
        @if(isset($id))
            <input type="hidden" name="id_category" value="{{$id}}">
        @else <label>
            <div>
           Categoria:
            @foreach($listCategories as $category)
                <div><input type="checkbox" name="{{$category->name}}" value="{{$category->name}}">
                <label for="{{$category->name}}">{{$category->name}}</label></div>
            @endforeach
            </div>
        </label>
        @endif
        <input type="submit" name="action" value="Add">
    </form>

    @if(isset($name))
        Ricette associate alla Categoria: {{$name}}
    @else
        Elenco completo delle ricette:
    @endif
    <ul>


        @foreach($list as $recipe)
            @if(!isset($name))
                <li>
                     {{$recipe->name}}  <p>CATEGORIE : <ul>@foreach($recipe->category as $category) <li>{{$category->name}}</li> @endforeach</ul></p>
                </li>
            @endif
            <p>
                <label>
                    Name:<input type="text" name="name" value="{{$recipe->name}}">
                </label>
                <label>
                    Url:<input type="text" name="url" value="{{$recipe->url}}">
                </label>
                @if(isset($id))
                    <input type="hidden" name="id_category" value="{{$id}}">
                @endif
                <input type="hidden" name="macro" value="0">
                <input type="hidden" name="id_recipe" value="{{$recipe->id}}">
                <input type="submit" name="action" value="Update">
                <input type="submit" name="action" value="delete">
                <a href="/database/ricette/dettaglio?id={{$recipe->id}}&&name={{$recipe->name}}">Dettaglio</a>
            </p>
        @endforeach
    </ul>
</body>
</html>
