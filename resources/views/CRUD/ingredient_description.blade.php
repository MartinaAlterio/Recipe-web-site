<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    Aggiungi una descrizione per [{{$url}}] :
    <form method="post">
        <label>description: <input type="text" name="description" value=""></label>
        <input type="hidden" name="url" value="{{$url}}">
        <input type="submit" name="action" value="insert">
        <a href="/database/ingredienti">Cancel</a>
        @csrf
    </form>
    Descrizioni già salvate:
    @foreach($descriptions as $value)
        <form method="post">
            <label>description: <input type="text" name="description" value="{{$value->description}}"></label>
            <input type="hidden", name="id" value="{{$value->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
             @csrf
        </form>

    @endforeach
</body>
</html>
