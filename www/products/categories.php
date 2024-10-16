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
    <link rel="stylesheet" href="/assets/css/products_main.css">
    <title>Категории</title>
</head>

<body>
<div class="container">
    <h1>Категории</h1>

    <div class="links">
        <a href="/products/">Назад</a>
        <a href="/products/add_category.php">Добавить категорию</a>
    </div>

    <div class="grid-container">
        <?php foreach ($categories as $category): ?>
            <div class="card">
                <div class="card-info">
                    <div>ID: <?= $category['id'] ?></div>
                    <h2><?= $category['name'] ?></h2>
                </div>

                <div class="card-links">
                    <a href="/products/change_category.php?id=<?= $category['id'] ?>">Изменить</a>
                    <a id="delete" href="/products/actions/delete_category.php?id=<?= $category['id'] ?>">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>