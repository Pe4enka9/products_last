<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

$products = $pdo->query("SELECT products.*, categories.name AS category
FROM products JOIN categories
ON products.category_id = categories.id
ORDER BY date DESC");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/products_main.css">
    <title>Продукты</title>
</head>

<body>

<div class="container">
    <h1>Продукты</h1>

    <div class="links">
        <a href="/products/create.php">Добавить товар</a>
        <a href="/products/categories.php">Категории</a>
    </div>

    <div class="grid-container">
        <?php foreach ($products as $product): ?>
            <div class="card">
                <div class="card-info">
                    <div>ID: <?= $product['id'] ?></div>
                    <h2><?= $product['name'] ?></h2>
                    <p><?= $product['description'] ?></p>
                    <div>Категория: <?= $product['category'] ?></div>
                    <div>Популярный: <?= $product['popular'] ? 'Да' : 'Нет' ?></div>
                    <div>Slug: <?= $product['slug'] ?></div>
                    <div>Дата создания: <?= $product['date'] ?></div>
                </div>

                <div class="card-links">
                    <a href="/products/edit.php?id=<?= $product['id'] ?>">Изменить</a>
                    <a id="delete" href="/products/actions/delete.php?id=<?= $product['id'] ?>">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>