<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div>Inserisci dettagli per</div>
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
        <input type="submit" name="action" value="insert">
        <a href="/database/categorie">Cancel</a>
        @csrf
    </form>
</body>
</html>
