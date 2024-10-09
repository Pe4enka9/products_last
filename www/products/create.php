<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/products/queries/category.php';

$categories = getCategories();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить товар</title>
</head>
<body>

<h1>Добавить товар</h1>

<form action="/products/actions/store.php" method="post">
    <div>
        <input type="text" name="name" placeholder="Название">
    </div>

    <div>
        <textarea name="description" placeholder="Описание"></textarea>
    </div>

    <div>
        <select name="category">
            <option selected hidden>Категория</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <input type="text" name="slug" placeholder="Slug">
    </div>

    <div>
        <input type="checkbox" name="popular" id="popular">
        <label for="popular">Популярный</label>
    </div>

    <input type="submit" value="Добавить">
</form>

</body>
</html>