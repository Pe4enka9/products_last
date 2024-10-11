<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/edit.css">
    <title>Добавить категорию</title>
</head>
<body>

<div class="container">
    <a href="/products/categories.php">Назад</a>

    <form class="edit-form" action="/products/actions/create_category.php" method="post">
        <fieldset>
            <legend>Название</legend>
            <input type="text" name="name" placeholder="Название">
        </fieldset>
        <input type="submit" value="Добавить">
    </form>
</div>

</body>
</html>