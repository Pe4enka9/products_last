<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/products/queries/category.php';

$products = $pdo->query("SELECT products.id, products.name, products.description, products.popular, products.category_id, categories.name AS category
FROM `products` JOIN `categories`
ON products.category_id = categories.id");

$categories = getCategories();

$currentCategory = $_GET['categories'] ?? 'all';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
</head>

<style>
    table, tr, th, td {
        padding: 5px;
        border: 1px solid #000;
        border-collapse: collapse;
    }
</style>

<body>

<h1>Популярные товары</h1>

<form method="get">
    <select name="categories">
        <option value="all" selected>Все</option>
        <?php foreach ($categories as $category): ?>
            <?php if ($currentCategory == $category['id']): ?>
                <option value="<?= $currentCategory ?>" selected><?= $category['name'] ?></option>
            <?php else: ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Искать">
</form>

<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Категория</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($products as $product): ?>
        <?php if ($product['popular'] && ($currentCategory == $product['category_id'] || $currentCategory === 'all')): ?>
            <tr>
                <td><?= $product['name'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><?= $product['category'] ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>