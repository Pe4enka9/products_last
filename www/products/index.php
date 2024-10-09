<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';
$products = $pdo->query("SELECT products.id, products.name, products.description, categories.name AS category, products.popular, products.slug
FROM products JOIN categories
ON products.category_id = categories.id");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Продукты</title>
</head>

<style>
    table, tr, th, td {
        padding: 5px;
        border: 1px solid #000;
        border-collapse: collapse;
    }
</style>

<body>

<h1>Продукты</h1>

<a href="/products/create.php">Добавить товар</a>
<a href="/products/add_category.php">Добавить категорию</a>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Категория</th>
        <th>Популярный</th>
        <th>Slug</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['description'] ?></td>
            <td><?= $product['category'] ?></td>
            <td><?= $product['popular'] ? 'Да' : 'Нет' ?></td>
            <td><?= $product['slug'] ?></td>
            <td><a href="/products/edit.php?id=<?= $product['id'] ?>">Изменить</a></td>
            <td><a href="/products/actions/delete.php?id=<?= $product['id'] ?>">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>