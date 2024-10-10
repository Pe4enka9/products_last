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
    <title>Категории</title>
</head>

<style>
    table, tr, th, td {
        padding: 5px;
        border: 1px solid #000;
        border-collapse: collapse;
    }
</style>

<body>

<h1>Категории</h1>
<a href="/products/">Назад</a>
<a href="/products/add_category.php">Добавить категорию</a>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Название</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($categories as $category): ?>
    <tr>
        <td><?= $category['id'] ?></td>
        <td><?= $category['name'] ?></td>
        <td><a href="/products/change_category.php?id=<?= $category['id'] ?>">Изменить</a></td>
        <td><a href="/products/actions/delete_category.php?id=<?= $category['id'] ?>">Удалить</a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>