<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
Inserisci una nuova Ricetta
    <form method="post">
        <p>
            <label>
                Nome:
                <input type="text" name="name" value="">
            </label>
            <label>
                Url:
                <input type="text" name="url" value="">
            </label>
            <label>
                Subheading:
                <input type="text" name="subheading" value="">
            </label>
            <label>
                Image:
                <input type="text" name="image" value="">
            </label>
            <label>
                Active:
                <input type="text" name="active" value="">
            </label>
            <input type="submit" name="action" value="insert">
            <a href="/database/ricette">cancel</a>
        </p>
        @csrf
    </form>

    Ricette Inserite:
    @foreach($recipes as $recipe)
        <form method="post">
            <label>
                Nome:
                <input type="text" name="name" value="{{$recipe->name}}">
            </label>
            <label>
                Url:
                <input type="text" name="url" value="{{$recipe->url}}">
            </label>
            <label>
                Subheading:
                <input type="text" name="subheading" value="{{$recipe->subheading}}">
            </label>
            <label>
                Image:
                <input type="text" name="image" value="{{$recipe->image}}">
            </label>
            <label>
                Active:
                <input type="text" name="active" value="{{$recipe->active}}">
            </label>
            <input type="hidden" name="id" value="{{$recipe->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
            <a href="/database/{{$recipe->url}}/ingredienti">Ingredienti</a>
            <a href="/database/{{$recipe->url}}/procedimenti">Procedimenti</a>
            <a href="/database/{{$recipe->url}}/collegamenti">Collegamenti</a>
            @csrf
        </form>
    @endforeach
</body>
</html>
