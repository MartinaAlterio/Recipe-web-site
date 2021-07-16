<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div>Inserisci una nuova categoria</div>
    <br>
    <form method="post">
        <label>
            Nome:<input type="text" name="name" value="">
        </label>
        <label>
            Url:<input type="text" name="url" value="">
        </label>
        <label>
            Macro:<input type="text" name="macro" value="">
        </label>
        <label>
            Immagine:<input type="text" name="image" value="">
        </label>
        <label>
            Descrizione:<input type="text" name="description" value="">
        </label>
        <input type="submit" name="action" value="insert">
        <a href="/database/categorie">Cancel</a>
        @csrf
    </form>
    <br>
    <div>Categorie esistenti</div>
    <br>
    <form method="post">
        @foreach($categories as $category)
            <label>
                Name: <input type="text" name="name" value="{{$category->name}}">
            </label>
            <label>
                Url: <input type="text" name="url" value="{{$category->url}}">
            </label>
            <label>
                Macro: <input type="text" name="macro" value="{{$category->macro}}">
            </label>
            <label>
                Immagine: <input type="text" name="image" value="{{$category->image}}">
            </label>
            <label>
                Descrizione: <input type="text" name="description" value="{{$category->description}}">
            </label>
            <input type="hidden" name="id" value="{{$category->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
            <a href="/database/categorie/ricette/{{$category->url}}">Ricette</a>
            @if($category->macro === 1)
                <a href="/database/categorie/collegamenti/{{$category->url}}">Collegamenti</a>
            @endif
            <br>
            <br>
        @endforeach
        @csrf
    </form>
</body>
</html>
