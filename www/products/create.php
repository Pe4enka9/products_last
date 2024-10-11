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
    <link rel="stylesheet" href="/assets/css/edit.css">
    <title>Добавить товар</title>
</head>
<body>

<div class="container">
    <a href="/products/">Назад</a>

    <form class="edit-form" action="/products/actions/store.php" method="post">
        <fieldset>
            <legend>Название</legend>
            <input type="text" name="name" placeholder="Название">
        </fieldset>

        <fieldset>
            <legend>Описание</legend>
            <textarea name="description" placeholder="Описание"></textarea>
        </fieldset>

        <fieldset>
            <legend>Категория</legend>
            <select name="category">
                <option selected hidden>Категория</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>

        <fieldset>
            <legend>Slug</legend>
            <input type="text" name="slug" placeholder="Slug">
        </fieldset>

        <div>
            <input type="checkbox" name="popular" id="popular">
            <label for="popular">Популярный</label>
        </div>

        <input type="submit" value="Добавить">
    </form>
</div>

</body>
</html>