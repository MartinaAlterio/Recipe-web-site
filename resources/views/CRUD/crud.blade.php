<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

Inserimento ingredienti:
    <form method="post">
        <p>Nome:
        <input type="text" name="name" value="">
        Url:
        <input type="text" name="url" value="">
        Attivo:
        <input type="text" name="active" value="">
        <input type="submit" name="action" value="insert">
        <a href="/database">cancel</a>
        </p>
        @csrf
    </form>
    Ingredienti inseriti:
    @foreach($ingredients as $value)
    <form method="post">
        <p>Nome:
        <input type="text" name="name" value="{{$value->name}}">
        Url:
        <input type="text" name="url" value="{{$value->url}}">
        Attivo:
        <input type="text" name="active" value="{{$value->active}}">
        <input type="hidden" name="id" value="{{$value->id}}">
        <input type="submit" name="action" value="update">
        <input type="submit" name="action" value="delete">
            @if($value->active === 1)
                <a href="/database/ingredienti/{{$value->url}}">Description</a>
            @endif</p>
        @csrf
    </form>
    @endforeach

</body>
</html>
